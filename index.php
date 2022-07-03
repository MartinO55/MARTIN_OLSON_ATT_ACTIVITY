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
                                                    //var_dump($tempArrayAfter2);
                                                    //$newSubTargetArray = $newSubTargetArray + $tempSkuDisplayNameArray;
                                                    //$tempArrayAfter2[] = array_push($tempArrayAfter1,$tempSkuDisplayNameArray);
                                                    //var_dump($tempArrayAfter2);

                                                } elseif ($singleSku == 'mPrice') {
                                                    echo "this is an mprice";

                                                    $tempMPriceArray = array('mPrice' => $skuEntryColumnHeading);
                                                    $tempArrayAfter3 = array_merge($tempArrayAfter2,$tempMPriceArray);

                                                } elseif ($singleSku == 'mListPrice') {
                                                    echo "this is an mlisprice";

                                                    $tempMListPriceArray = array('mListPrice' => $skuEntryColumnHeading);
                                                    $tempArrayAfter4 = array_merge($tempArrayAfter3, $tempMListPriceArray);

                                                } elseif ($singleSku == 'mModel'){
                                                    echo 'this is the model';

                                                    $tempMModelArray = array('mModel'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter5 = array_merge($tempArrayAfter4,$tempMModelArray);

                                                } elseif ($singleSku =='mLargeImage'){
                                                    echo 'this is the image';

                                                    $tempMLargeImageArray = array('mLargeImage'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter6 = array_merge($tempArrayAfter5,$tempMLargeImageArray);

                                                } elseif ($singleSku == 'mId'){
                                                    echo 'this is the mid';

                                                    $tempMIdArray = array('mId'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter7 = array_merge($tempArrayAfter6, $tempMIdArray);

                                                } elseif ($singleSku == 'mProductPageURL'){
                                                    echo 'mproductpageurl is this';

                                                    $tempProductPageURLArray = array('mProductPageURL'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter8 = array_merge($tempArrayAfter7,$tempProductPageURLArray);

                                                } elseif ($singleSku == 'mName') {
                                                    echo 'this is the mname';

                                                    $tempmNameArray = array('mName'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter9 = array_merge($tempArrayAfter8,$tempmNameArray);

                                                } elseif ($singleSku == 'salesRank') {
                                                    echo 'this is the salesrank';
                                                    //so I just realised this should totally be a function
                                                    $tempSalesRankArray = array('salesRank'=>$skuEntryColumnHeading);
                                                    $tempArrayAfter10 = array_merge($tempArrayAfter9,$tempSalesRankArray);

                                                } elseif ($singleSku == 'mStarRatings'){
                                                    echo "this is the mstarrating";

                                                    $tempmStarRatingsArray = array('mStarRatings'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter11 = array_merge($tempArrayAfter10, $tempmStarRatingsArray);

                                                } elseif ($singleSku == 'mProductId') {
                                                    echo 'this is hte mproductid';

                                                    $tempmProductIdArray = array('mProductId'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter12 = array_merge($tempArrayAfter11, $tempmProductIdArray);

                                                } elseif ($singleSku == 'deviceType'){
                                                    echo 'this is the devicetype';
                                                    
                                                    $tempDeviceTypeArray = array('deviceType'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter13 = array_merge($tempArrayAfter12, $tempDeviceTypeArray);

                                                } elseif ($singleSku == 'mMobileProductPageURL'){
                                                    echo 'this is the mobile product page url';

                                                    $tempmobileProductPageurlArray = array('mMobileProductPageURL'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter14 = array_merge($tempArrayAfter13, $tempmobileProductPageurlArray);

                                                } elseif ($singleSku == 'mProductPageURLEs') {
                                                    echo 'this is the product page urles';

                                                    $tempmProductPageURLEs = array('mProductPageURLEs'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter15 = array_merge($tempArrayAfter14, $tempmProductPageURLEs);

                                                } elseif ($singleSku == 'mDescription'){
                                                    echo 'this is the mdescription';

                                                    $tempMDescriptionArray = array('mDescription'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter16 = array_merge($tempArrayAfter15, $tempMDescriptionArray);

                                                } elseif ($singleSku == 'mDueToday'){
                                                    echo ' this is the mduetoday';

                                                    $tempMDueTodayArray = array('mDueToday'=> $skuEntryColumnHeading);
                                                    $tempArrayAfter17 = array_merge($tempArrayAfter16, $tempMDueTodayArray);

                                                } elseif ($singleSku == 'PDPPageURL'){
                                                    echo 'this is the pdppageurl';

                                                    $tempPDPPageURLArray =array('PDPPageURL'=>$skuEntryColumnHeading);
                                                    $tempArrayAfter18 = array_merge($tempArrayAfter17,$tempPDPPageURLArray);

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