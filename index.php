<?php
    $fileSourceURL = 'https://cdn.flashtalking.com/feeds/test_data/att_product_data.json';
    $fileBaseName = basename($fileSourceURL);
    $fileContents = file_get_contents($fileSourceURL);
    $fileForDisplay = json_decode($fileContents,true);

    $header = false;
    $arrayToPassForCSVing = [];

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
                if(!is_array($value))
                { 
                    echo '<br>1D object index: ' . $key . '<br>';
                }
                    else {
                            foreach($value as $sku => $skuEntry) 
                            {if (!is_array($skuEntry)) {echo 'You Should not be here';} 
                                else {  //this cuts the two 1d things (I presume they are unwanted and unloved)
                                        $targetArray = [];//need a new array for each entry that can hold the stuff being pushed from the logic below, then that array needs to be pushed to the one being created for CSVing
                                    foreach($skuEntry as $singleSku => $skuEntryColumnHeading)
                                        {   $newSubTargetArray = [];
                                            
                                            //OKAY. so singleSku is the column heading ID. skuEntryColumnHeading is the data in each line, and some of these are still arrays
                                            if (!is_array($skuEntryColumnHeading))
                                            {
                                                echo '<br>2D column index: ' . $singleSku . '<br>';//all the data we need can be found here
                                                if($singleSku == 'mBrand'){ // && brand !apple
                                                    echo "this is an mbrand";
                                                    if($skuEntryColumnHeading != 'Apple'){
                                                        echo ' this is not an apple device';
                                                        $tempmBrandArray = array('mBrand'=> $skuEntryColumnHeading);
                                                        $tempArrayAfter1 = array_merge($newSubTargetArray,$tempmBrandArray);
                                                        //$tempArrayAfter1 = array_push($newSubTargetArray,$tempmBrandArray);
                                                        //var_dump($tempArrayAfter1);
                                                    }
                                                } elseif($singleSku == 'skuDisplayName') {// and remove colour descriptions? 
                                                    echo "this is a skudisplayname with the colour";
                                                    //use strrpos to find the position in the string of the last '-' in a variable
                                                    $lastHyphenInSkuDisplayNameLoc = strrpos($skuEntryColumnHeading,'-',-1);
                                                    //then use substr to cut the string at that location
                                                    $skuDisplayNameWithoutColour = substr($skuEntryColumnHeading,0,$lastHyphenInSkuDisplayNameLoc);
                                                    //echo $skuDisplayNameWithoutColour;//and then return this instead
                                                    
                                                    //use that 
                                                    $tempSkuDisplayNameArray = array('skuDisplayName' => $skuDisplayNameWithoutColour);
                                                    
                                                    $tempArrayAfter2 = array_merge($tempArrayAfter1,$tempSkuDisplayNameArray);
                                                    var_dump($tempArrayAfter2);
                                                    //$newSubTargetArray = $newSubTargetArray + $tempSkuDisplayNameArray;
                                                    //$tempArrayAfter2[] = array_push($tempArrayAfter1,$tempSkuDisplayNameArray);
                                                    //var_dump($tempArrayAfter2);

                                                } elseif ($singleSku == 'mPrice') {
                                                    echo "this is an mprice";

                                                    $tempMPriceArray = array('mPrice' => $skuEntryColumnHeading);
                                                    $tempArrayAfter3 = array_merge($tempArrayAfter2,$tempMPriceArray);

                                                } elseif ($singleSku == 'mListPrice') {
                                                    echo "this is an mlisprice";
                                                } elseif ($singleSku == 'mModel'){
                                                    echo 'this is the model';
                                                } elseif ($singleSku =='mLargeImage'){
                                                    echo 'this is the image';
                                                } elseif ($singleSku == 'mId'){
                                                    echo 'this is the mid';
                                                } elseif ($singleSku == 'mProductPageURL'){
                                                    echo 'mproductpageurl is this';
                                                } elseif ($singleSku == 'mName') {
                                                    echo 'this is the mname';
                                                } elseif ($singleSku == 'salesRank') {
                                                    echo 'this is the salesrank';
                                                } elseif ($singleSku == 'mStarRatings'){
                                                    echo "this is the mstarrating";
                                                } elseif ($singleSku == 'mProductId') {
                                                    echo 'this is hte mproductid';
                                                } elseif ($singleSku == 'deviceType'){
                                                    echo 'this is the devicetype';
                                                } elseif ($singleSku == 'mMobileProductPageURL'){
                                                    echo 'this is the mobile product page url';
                                                } elseif ($singleSku == 'mProductPageURLEs') {
                                                    echo 'this is the product page urles';
                                                } elseif ($singleSku == 'mDescription'){
                                                    echo 'this is the mdescription';
                                                } elseif ($singleSku == 'mDueToday'){
                                                    echo ' this is the mduetoday';
                                                } elseif ($singleSku == 'PDPPageURL'){
                                                    echo 'this is the pdppageurl';
                                                } else {
                                                    echo 'dont want this';
                                                }
                                                
                                               
                                            } 
                                            else 
                                                {
                                                    foreach($skuEntryColumnHeading as $skuSubCollumn => $skuSubColumnKey)
                                                    {
                                                        if(!is_array($skuSubColumnKey))
                                                        {
                                                            echo "<br>3D sku subcolumn contents: " . $skuSubColumnKey;

                                                            if ($skuSubColumnKey == 'M-CAT-SMARTPHONES'){//so this is the category we want, and if we only add this it should automatically filter out tablets and wearables
                                                                 echo 'this a smartphone';
                                                             }
                                                        } else 
                                                            {
                                                                foreach($skuSubColumnKey as $skuSubColumnEntry => $skuSubSubColumnKey)
                                                                {
                                                                    if (!is_array($skuSubSubColumnKey))
                                                                    {
                                                                        echo "<br>4D sku Sub Sub Column Contents: " . $skuSubSubColumnKey;
                                                                    } else 
                                                                        {
                                                                            foreach ($skuSubSubColumnKey as $sku5DColumnEntry => $sku5DColumnKey) {
                                                                               echo "<br> 5d Column contents: " . $sku5DColumnKey;//So we could keep extending this algorithm for another 2 or 3 dimensions I think, but we are just dropping that data anyway so I don't think we need to
                                                                            }
                                                                        }
                                                                
                                                                }
                                                            }
                                                        
                                                    }
                                                }      
                                        }
                                    }
                            }
                        }  
            }
             

            ?>
        </div>
    </body>
</html>