<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>/home/oliwer/wallpapers</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="title">/home/oliwer/wallpapers</div>

	<div class="toolbar">
		<a href="./">Index</a> |
		<a href="http://oliwer.net/blog">Blog</a>
	</div>

	<div id="main-content">
		<ul>
<?php

// START OF PARAMETERS SECTION
$columns=4;                  //number of images per line
$ratio=5;                    //ratio imageSize / thumbnailImageSize
$quality=50;                 //thumbnail image quality (0: worst to 100:best)
$thumb_dir = "thumb";        //directory created to stored small images
$thumb_prefix = "thumb_";    //prefix for generated images
// END OF PARAMETERS SECTION


$mydirectory= '.';          //directory in which images are fetched
$counter=0;
$nbfiles = 0;
$currfile =  "";
$filestab[0] =  "";

$handle=opendir($mydirectory);

//create a directory for thumbnail images
if (! is_dir($thumb_dir))
{
   mkdir($thumb_dir, 0777);
}

while ($currfile = readdir($handle))
{
// We get the extension of the current file and keep only image files
   $extension= strtolower(substr( strrchr( $currfile,  "." ), 1 ));
   if ($extension== "gif" || $extension== "jpg" || $extension== "jpeg" ||
       $extension== "png")
   {
      $nbfiles++;
      $currfile = trim($currfile);
      $filestab[$nbfiles] = $currfile;

      //if ($ishome ==  "")
      //{
         $size = GetImageSize($currfile);
         $width = $size[0] / $ratio;
         $height = $size[1] / $ratio;
         $format = $size[2]; //1 = GIF, 2 = JPG, 3 = PNG, 5 = PSD, 6 = BMP

        $currthumbfile = "./" . $thumb_dir . "/" . $thumb_prefix . $currfile;
        if (! file_exists($currthumbfile))
        {
           $image_p = imagecreatetruecolor($width, $height);
	   //GIF format is not supported anymore by GD lib...
           if ($format == 2) { //JPG
                 $im = imagecreatefromjpeg($currfile);
		 imagecopyresampled($image_p, $im, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
	   }
           else if ($format == 3) { //PNG
                 $im = imagecreatefrompng($currfile);
		 imagecopyresampled($image_p, $im, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
	   }
           if (!$im)
           {
               $currthumbfile = $currfile;
           }
           else
           {
              Imagejpeg($image_p, $currthumbfile, $quality);
              ImageDestroy($im);
	      ImageDestroy($image_p);
           }
        }

        $currfile = str_replace(" ","%20",$currfile); // Allow filenames with space characters
        $currthumbfile = str_replace(" ","%20",$currthumbfile); // Allow filenames with space characters

         echo  "			<li><a href=$currfile>";
         echo  "<img src=$currthumbfile width=$width heaight=$height";
         $currfile = str_replace("%20"," ",$currfile); // Clean display of filenames with space characters
         echo " alt=\"Full size\" />";
         $currfile = str_replace(" ","%20",$currfile);   //Clean display of filenames with space characters
         echo  "</a></li>\n";
         $counter++;
         if ($counter == $columns)
         {
            $counter = 0;
            //echo  "		<br />";
         }
      //}
   }
}
closedir($handle);
?>
		</ul>
	</div>
</body>
</html>
