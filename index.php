<?php
    $fileSourceURL = 'https://cdn.flashtalking.com/feeds/test_data/att_product_data.json';
    $fileBaseName = basename($fileSourceURL);
    $fileContents = file_get_contents($fileSourceURL);
    $fileForDisplay = json_decode($fileContents,true);

    $header = false;

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <div>
        <a href="https://cdn.flashtalking.com/feeds/test_data/att_product_data.json">File here</a>
        </div>
        <div>
            <?php
            foreach($fileForDisplay as $key => $value){
                if(!is_array($value)){
                    echo '<br>object index: ' . $key . '<br>';
                } else {
                    foreach($value as $sku => $skuEntry) {
                        if (!is_array($skuEntry)){//this entry is always an array, so this should never run
                            echo 'You Should not be here';
                        } else {
                            foreach($skuEntry as $singleSku => $skuEntryColumnHeading){//OKAY. so singleSku is the column heading ID. skuEntryColumnHeading is the data in each line, and some of these are still arrays
                                echo '<br> column index: ' . $singleSku;
                            }
                        }
                      }
                }  
            }
             

            ?>
        </div>
    </body>
</html>