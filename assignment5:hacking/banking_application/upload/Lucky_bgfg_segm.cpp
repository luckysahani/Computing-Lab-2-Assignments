#include "opencv2/core/core.hpp"
#include "opencv2/imgproc/imgproc.hpp"
#include "opencv2/video/background_segm.hpp"
#include "opencv2/highgui/highgui.hpp"
#include <stdio.h>
#include <cstdlib>
#include <iostream>
#include <fstream>
#include <string.h>

using namespace std;
using namespace cv;

static void help()
{
 printf("\nDo background segmentation, especially demonstrating the use of cvUpdateBGStatModel().\n"
"Learns the background at the start and then segments.\n"
"Learning is togged by the space key. Will read from file or camera\n"
"Usage: \n"
"			./bgfg_segm [--camera]=<use camera, if this key is present>, [--file_name]=<path to movie file> \n\n");
}

const char* keys =
{
    "{c |camera   |true    | use camera or not}"
    "{fn|file_name|tree.avi | movie file             }"
};

 int fno=0;int plate = 0;
string make_str(int n)      
{
    string ans = "";
    if(n == 0) return "0";
    while(n > 0) {
        ans.push_back((char)(n%10 + '0'));
        n /= 10;
    }
    reverse(ans.begin(), ans.end());
    return ans;
}

//this is a sample for foreground detection functions
int main(int argc, const char** argv)
{
    VideoCapture cap;
    bool update_bg_model = true;

    cap.open(argv[1]);

    if( !cap.isOpened() )
    {
        printf("can not open camera or video file\n");
        return -1;
    }

    namedWindow("image", WINDOW_NORMAL);
    BackgroundSubtractorMOG2 bg_model;//(100, 3, 0.3, 5);

    Mat img, fgmask, fgimg,reimg;                 //img input image, fgmask: foreground mask ,reimg: resized image
    int s = 2;					//resize factor to resize frame 	
    VideoWriter out_capture("video.avi", CV_FOURCC('M','J','P','G'), 5,Size(img.size().width/s,img.size().height/s));                           
									
    for(;;)	
    {
        cap >> img;			

        if( img.empty() )
            break;

        resize(img, reimg, Size(img.size().width/s, img.size().height/s) );  		//frame size is reduced by factor s and stored in reimg

        if( fgimg.empty() )
          fgimg.create(reimg.size(), reimg.type());
          
        //update the model
        bg_model(reimg, fgmask, update_bg_model ? -1 : 0);

      
        cv::Mat img_mask1;
    	fgmask.copyTo(img_mask1);
    	
    	cv::erode(img_mask1,img_mask1,cv::Mat());
   	    cv::dilate(img_mask1,img_mask1,cv::Mat());
   	    for ( int i = 1; i < 10; i = i + 2 )
        { 
          // blur( img_mask1, img_mask1, Size( i, i ), Point(-1,-1) );
            GaussianBlur( img_mask1, img_mask1, Size( i, i ), 0, 0 );
        }

	    std::vector<std::vector<cv::Point> > contours;
   
        cv::findContours( img_mask1, 			// binary input image
                          contours, 			// vector of vectors of points
                          CV_RETR_EXTERNAL, 		// retrieve only external contours
                          CV_CHAIN_APPROX_NONE); 	// detect all pixels of each contour
   
   	/// Get the moments of contours
	  vector<Moments> mu(contours.size() );
	  for( int i = 0; i < contours.size(); i++ )
	  { 
	  	mu[i] = moments( contours[i], false ); 
	  }

	  ///  Get the mass centers:
	  vector<Point2f> mc( contours.size() );
	  for( int i = 0; i < contours.size(); i++ )
	  { 
	  	mc[i] = Point2f( mu[i].m10/mu[i].m00 , mu[i].m01/mu[i].m00 ); 
	  }


        string path = "output/used/";
        string path1="output/unused/";
        string path2="output/foreground/";
        bool flag = false;
        fno++;

        //if(fno > 2000) break;
        for (int i = 0; i < contours.size(); i++)
        {
            if(contourArea(contours[i])>3000)
            {
               drawContours(reimg,              // draw contours here
                                contours, i,    // draw these contours
                                Scalar(0, 0, 255),  // set color
                                2);
               circle( reimg, mc[i], 4,Scalar(0, 255, 0), -1, 8, 0 );
               if(mc[i].y>120 && mc[i].y < 300 )
               flag = true;
            }
        }
    	if(flag) 
        {   
            cout << fno << "\n";
            cv::imwrite( path + make_str(fno) + ".jpg",img);
            cv::imwrite( path2 + make_str(fno) + ".jpg",reimg);
            out_capture.write(img);
        } 
        else 
        {
            cv::imwrite( path1 + make_str(fno) + ".jpg",img);
        }
        imshow("image", img);
	    imshow("Masked", reimg);
        char k = (char)waitKey(1);
        if( k == 27 ) break;
        if( k == ' ' )
        {
            update_bg_model = !update_bg_model;
            if(update_bg_model)
                printf("Background update is on\n");
            else
                printf("Background update is off\n");
        }
    }

    return 0;
}
