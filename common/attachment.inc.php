<?
    function output_image($mime, $blob, $W, $H, $is_cover=false){
        if( $W > 0 ){
            $src = new Imagick();
            try{
                $src->readImageBlob($blob);
            }
            catch( Exception $e ){
                header("Content-Type: $mime");
                echo $blob;
            }

            $geo = $src->getImageGeometry();
            $w = $geo['width'];
            $h = $geo['height'];

            if( $w==$W && $h==$H || !$H && $w<=$W ){
                header("Content-Type: $mime");
                echo $blob;
            }
            else{
                if( $H ){
                    if( $is_cover ){
                        if( $w*$H == $W*$h )
                            $src->resizeImage($W, $H, Imagick::FILTER_LANCZOS, 1, true);
                        elseif( $w*$H > $W*$h ){
                            $src->resizeImage($w*$H/$h, $H, Imagick::FILTER_LANCZOS, 1, true);
                            $src->cropImage($W, $H, ($w*$H/$h-$W)/2, 0);
                        }
                        else{
                            $src->resizeImage($W, $h*$W/$w, Imagick::FILTER_LANCZOS, 1, true);
                            $src->cropImage($W, $H, 0, ($h*$W/$w-$H)/2);
                        }
                    }
                    else{
                        $src->resizeImage($W, $H, Imagick::FILTER_LANCZOS, 1, true);
                        if( $w*$H != $W*$h ){
                            $out = new Imagick();
                            $out->newImage($W, $H, new ImagickPixel('#FFFFFF'));
                            $geo = $src->getImageGeometry();
                            $w = $geo['width'];
                            $h = $geo['height'];
                            $x = ($W-$w) / 2;
                            $y = ($H-$h) / 2;
                            $out->compositeImage($src, Imagick::COMPOSITE_ATOP, $x, $y);
                            $src = $out;
                        }
                    }
                }
                else{
                    $H = $W/$w*$h+10;
                    $src->resizeImage($W, $H, Imagick::FILTER_LANCZOS, 1, true);
                }
                if( $W*$H < 200000 ){
                    $src->setImageFormat('png');
                    header("Content-Type: image/png");
                }
                else{
                    $src->setImageFormat('jpg');
                    header("Content-Type: image/jpeg");
                }
                echo $src;
            }
        }
        else{
            header("Content-Type: $mime");
            echo $blob;
        }
    }
