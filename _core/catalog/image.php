<?php
/*

Formats images for OPs and replies.

Shouldn't be used without a parent (post.php).
Also needs to be cleaned up.

*/

class CatalogImage {
    function format($input) {
        extract($input);
        
        $imgdir   = IMG_DIR;
        $thumbdir = DATA_SERVER . BOARD_DIR . "/" . THUMB_DIR;
        
        // Picture file name
        $img        = $path . $tim . $ext;
        $displaysrc = DATA_SERVER . BOARD_DIR . "/" . $imgdir . $tim . $ext;
        $linksrc    = ((USE_SRC_CGI == 1) ? (str_replace(".cgi", "", $imgdir) . $tim . $ext) : $displaysrc);
        if (defined('INTERSTITIAL_LINK'))
            $linksrc = str_replace(INTERSTITIAL_LINK, "", $linksrc);
        $src = IMG_DIR . $tim . $ext;
        // img tag creation
        $imgsrc    = "$no";
        
        // if ($ext) ?
        
        if (is_file(THUMB_DIR . $tim . 's.jpg')) {
            //Start by determing if the file actually exists, if so continue here.
            
            $shortmd5 = base64_encode(pack("H*", $md5)); // turn the 32-byte ascii md5 into a 24-byte base64 md5

            if (!$tn_w && !$tn_h && $ext == ".gif") {
                $tn_w = $w;
                $tn_h = $h;
            }
            
            if ($spoiler) {
                $imgsrc = "<img src='" . SPOILER_THUMB . "' border='0'   alt='" . $size . "B' md5='{$shortmd5}'>";
            } else {
                if (@is_file(THUMB_DIR . $tim . 's.jpg')) {
                    $imgsrc = "<img class='catalog-thumb' src='{$thumbdir}{$tim}s.jpg' data-md5='{$shortmd5}'>";
                } else {
                    $imgsrc = "<span class='tn_thread' title=''" . $size . "B'>Thumbnail unavailable</span>";
                }
            }
        } else {
            //Thumbnail does not exist, continue here.
            $imgsrc = "<img src='" . CSS_PATH . "/imgs/filedeleted-res.gif' alt='File deleted.'>";
        }
        
        return "<a href='" . RES_DIR . $no . "#" . $no . "'>" . $imgsrc . "</a>";
    }
}

?>
