<?php  if(session_status()==PHP_SESSION_NONE) session_start();
?>

<?php ?>

<script>
var currentLastItem = 0;
function AddItem()
{
    var newItem = "DivItem" + (currentLastItem + 1);
    document.getElementById(newItem).style.display = "block";
    currentLastItem ++;
}
function RemoveItem()
{
    var currentItem = "DivItem" + currentLastItem;
    document.getElementById(currentItem).style.display = "none";
    clearChildren(document.getElementById(currentItem));
    currentLastItem --;
}

function clearChildren(element) {
   for (var i = 0; i < element.childNodes.length; i++) {
      var e = element.childNodes[i];
      if (e.tagName) switch (e.tagName.toLowerCase()) {
         case 'input':
            switch (e.type) {
               case "radio":
               case "checkbox": e.checked = false; break;
               case "button":
               case "submit":
               case "image": break;
               default: e.value = ''; break;
            }
            break;
         case 'select': e.selectedIndex = 0; break;
         case 'textarea': e.innerHTML = ''; break;
         default: clearChildren(e);
      }
   }
}
</script>

<?php

// inyReceiveTypeCode: 1 - all, 2 - select one
// inyTargetTypeCode: 1 - all acc, 2 - list of acc, 3 - all chars, 4 - list of chars
// xmlAccountIDs - XML list of acc IDs (omit if type code is not 2)
// xmlAccountNames - XML list of acc names (omit if type code is not 2)
// xmlCharacterIDs - ditto but chars (omit if type code is not 4)
// xmlCharacterNames - ditto
// inyTargetWorldID - world ID (should be 1 since none of us have multiworld)
// inyTargetClassCode - allowed class/job ID (respects ancestors), omit if no limit
// inyTargetMinLevel - duh
// inyTargetMaxLevel - duh
// sdtReserveSendDate - when to send the reward
// sdtExpirationDate - when the reward expires (can no longer be claimed)
// nvcEventName - name of the event (does not show in game)
// nvcSenderName - name of the sender to display
// nvcContent - the message in-game
// inbRewardCoin - reward copper
// xmlEventRewardItems - XML list of items (see template)
// inyEventRewardTypeCode: 1 - GM, 2 - system, I think it just is for internal


// xml templates :
// <root><Account AccountID="1234"/><Account AccountID="4567"/></root>
// <root><Account AccountName="Vahrheit"/>...</root>
// <root><Character CharacterID="testchar"/><same thing></root>
// <root><Character CharacterName="testchar"/><same thing></root>

function listToArray($list)
{
    if (empty($list)) return null;
    return explode(",",$list);
}

function listToXML($array,$head,$subhead)
{
    if (empty($array)) return null;
    $returnXML = '<root>';
    foreach ($array as &$value)
    {
        $returnXML = $returnXML . '<' . $head . ' ' . $subhead . '=' . '"' . $value . '"/>';
    }
    $returnXML = $returnXML . '</root>';
    return $returnXML;
}

function itemToXML($itemArray)
{
    if (empty($itemArray['ItemID'])) return null;
    else $effectiveArray['ItemID'] = $itemArray['ItemID'];

    if (empty($itemArray['SoulBound'])) $effectiveArray['SoulBound'] = 0;
    else $effectiveArray['SoulBound'] = $itemArray['SoulBound'];

    if (empty($itemArray['Eternal'])) $effectiveArray['Eternal'] = 0;
    else $effectiveArray['Eternal'] = $itemArray['Eternal'];

    if (empty($itemArray['ProductFlag'])) $effectiveArray['ProductFlag'] = 0;
    else $effectiveArray['ProductFlag'] = $itemArray['ProductFlag'];

    if (empty($itemArray['Count'])) $effectiveArray['Count'] = 1;
    else $effectiveArray['Count'] = $itemArray['Count'];

    if (empty($itemArray['Durability'])) $effectiveArray['Durability'] = 0;
    else $effectiveArray['Durability'] = $itemArray['Durability'];

    if (empty($itemArray['RandomSeed'])) $effectiveArray['RandomSeed'] = 0;
    else $effectiveArray['RandomSeed'] = $itemArray['RandomSeed'];

    if (empty($itemArray['EnhanceLevel'])) $effectiveArray['EnhanceLevel'] = 0;
    else $effectiveArray['EnhanceLevel'] = $itemArray['EnhanceLevel'];

    if (empty($itemArray['Potential'])) $effectiveArray['Potential'] = 0;
    else $effectiveArray['Potential'] = $itemArray['Potential'];

    if (empty($itemArray['Seals'])) $effectiveArray['Seals'] = 0;
    else $effectiveArray['Seals'] = $itemArray['Seals'];

    if (empty($itemArray['Option'])) $effectiveArray['Option'] = 0;
    else $effectiveArray['Option'] = $itemArray['Option'];

    if (empty($itemArray['Lifespan'])) $effectiveArray['Lifespan'] = 0;
    else $effectiveArray['Lifespan'] = $itemArray['Lifespan'];

    if (empty($itemArray['JewelType'])) $effectiveArray['JewelType'] = 0;
    else $effectiveArray['JewelType'] = $itemArray['JewelType'];

    $ret = '<Item ProductFlag="' . $effectiveArray['ProductFlag'] . '" ItemID="' . $effectiveArray['ItemID'] .
       '" ItemCount="' . $effectiveArray['Count'] . '" ItemDurability="' . $effectiveArray['Durability'] . 
       '" RandomSeed="' . $effectiveArray['RandomSeed'] . '" ItemLevel="' . $effectiveArray['EnhanceLevel'] . 
       '" ItemPotential="' . $effectiveArray['Potential'] . '" SoulBoundFlag="' . $effectiveArray['SoulBound'] . 
       '" SealCount="' . $effectiveArray['Seals'] . '" ItemOption="' . $effectiveArray['Option'] . 
       '" ItemLifespan="' . $effectiveArray['Lifespan'] . '" EternityFlag="' . $effectiveArray['Eternal'] . 
       '" DragonJewelType="' . $effectiveArray['JewelType'] . '" />';

    return $ret;

}

if (isset($_SESSION["AccountLevelAdmin"]))
{
    if (isset($_POST["Send"]))
    {
        include('../configlogin.php');
        $conn = sqlsrv_connect($serverName, $conn_array);

        // SET POST Variables to custom params
        $myparams['ReceiveTypeCode'] = $_POST['ReceiveTypeCode'];
        $myparams['TargetTypeCode'] = $_POST['TargetTypeCode'];
        $myparams['TargetWorldID'] = $_POST['TargetWorldID'];
        
        if(empty($_POST['TargetClassCode'])) $myparams['TargetClassCode'] = null;
        else $myparams['TargetClassCode'] = $_POST['TargetClassCode'];
        
        $myparams['TargetMinLevel'] = $_POST['TargetMinLevel'];
        $myparams['TargetMaxLevel'] = $_POST['TargetMaxLevel'];
        $myparams['ReserveSendDate'] = date('Y-m-d H:i:s', strtotime($_POST['ReserveSendDate']));
        $myparams['ExpirationDate'] = date('Y-m-d H:i:s', strtotime($_POST['ExpirationDate']));
        $myparams['EventName'] = $_POST['EventName'];
        $myparams['SenderName'] = $_POST['SenderName'];
        $myparams['Content'] = $_POST['Content'];
        $myparams['RewardCoin'] = $_POST['RewardCoin'];
        $myparams['EventRewardTypeCode'] = $_POST['EventRewardTypeCode'];

        //itemList
        $item1['ItemID'] = $_POST['ItemID1'];
        $item1['ProductFlag'] = $_POST['ProductFlag1'];
        $item1['Count'] = $_POST['Count1'];
        $item1['Durability'] = $_POST['Durability1'];
        $item1['RandomSeed'] = $_POST['RandomSeed1'];
        $item1['EnhanceLevel'] = $_POST['EnhanceLevel1'];
        $item1['Potential'] = $_POST['Potential1'];
        $item1['SoulBound'] = $_POST['SoulBound1'];
        $item1['Seals'] = $_POST['Seals1'];
        $item1['Option'] = $_POST['Option1'];
        $item1['Lifespan'] = $_POST['Lifespan1'];
        $item1['Eternal'] = $_POST['Eternity1'];
        $item1['JewelType'] = $_POST['JewelType1'];

        $item2['ItemID'] = $_POST['ItemID2'];
        $item2['ProductFlag'] = $_POST['ProductFlag2'];
        $item2['Count'] = $_POST['Count2'];
        $item2['Durability'] = $_POST['Durability2'];
        $item2['RandomSeed'] = $_POST['RandomSeed2'];
        $item2['EnhanceLevel'] = $_POST['EnhanceLeve2'];
        $item2['Potential'] = $_POST['Potential2'];
        $item2['SoulBound'] = $_POST['SoulBound2'];
        $item2['Seals'] = $_POST['Seals2'];
        $item2['Option'] = $_POST['Option2'];
        $item2['Lifespan'] = $_POST['Lifespan2'];
        $item2['Eternal'] = $_POST['Eternity2'];
        $item2['JewelType'] = $_POST['JewelType2'];
        
        $item3['ItemID'] = $_POST['ItemID3'];
        $item3['ProductFlag'] = $_POST['ProductFlag3'];
        $item3['Count'] = $_POST['Count3'];
        $item3['Durability'] = $_POST['Durability3'];
        $item3['RandomSeed'] = $_POST['RandomSeed3'];
        $item3['EnhanceLevel'] = $_POST['EnhanceLevel3'];
        $item3['Potential'] = $_POST['Potential3'];
        $item3['SoulBound'] = $_POST['SoulBound3'];
        $item3['Seals'] = $_POST['Seals3'];
        $item3['Option'] = $_POST['Option3'];
        $item3['Lifespan'] = $_POST['Lifespan3'];
        $item3['Eternal'] = $_POST['Eternity3'];
        $item3['JewelType'] = $_POST['JewelType3'];

        $item4['ItemID'] = $_POST['ItemID4'];
        $item4['ProductFlag'] = $_POST['ProductFlag4'];
        $item4['Count'] = $_POST['Count4'];
        $item4['Durability'] = $_POST['Durability4'];
        $item4['RandomSeed'] = $_POST['RandomSeed4'];
        $item4['EnhanceLevel'] = $_POST['EnhanceLevel4'];
        $item4['Potential'] = $_POST['Potential4'];
        $item4['SoulBound'] = $_POST['SoulBound4'];
        $item4['Seals'] = $_POST['Seals4'];
        $item4['Option'] = $_POST['Option4'];
        $item4['Lifespan'] = $_POST['Lifespan4'];
        $item4['Eternal'] = $_POST['Eternity4'];
        $item4['JewelType'] = $_POST['JewelType4'];

        $item5['ItemID'] = $_POST['ItemID5'];
        $item5['ProductFlag'] = $_POST['ProductFlag5'];
        $item5['Count'] = $_POST['Count5'];
        $item5['Durability'] = $_POST['Durability5'];
        $item5['RandomSeed'] = $_POST['RandomSeed5'];
        $item5['EnhanceLevel'] = $_POST['EnhanceLevel5'];
        $item5['Potential'] = $_POST['Potential5'];
        $item5['SoulBound'] = $_POST['SoulBound5'];
        $item5['Seals'] = $_POST['Seals5'];
        $item5['Option'] = $_POST['Option5'];
        $item5['Lifespan'] = $_POST['Lifespan5'];
        $item5['Eternal'] = $_POST['Eternity5'];
        $item5['JewelType'] = $_POST['JewelType5'];

        $item6['ItemID'] = $_POST['ItemID6'];
        $item6['ProductFlag'] = $_POST['ProductFlag6'];
        $item6['Count'] = $_POST['Count6'];
        $item6['Durability'] = $_POST['Durability6'];
        $item6['RandomSeed'] = $_POST['RandomSeed6'];
        $item6['EnhanceLevel'] = $_POST['EnhanceLevel6'];
        $item6['Potential'] = $_POST['Potential6'];
        $item6['SoulBound'] = $_POST['SoulBound6'];
        $item6['Seals'] = $_POST['Seals6'];
        $item6['Option'] = $_POST['Option6'];
        $item6['Lifespan'] = $_POST['Lifespan6'];
        $item6['Eternal'] = $_POST['Eternity6'];
        $item6['JewelType'] = $_POST['JewelType6'];

        $item7['ItemID'] = $_POST['ItemID7'];
        $item7['ProductFlag'] = $_POST['ProductFlag7'];
        $item7['Count'] = $_POST['Count7'];
        $item7['Durability'] = $_POST['Durability7'];
        $item7['RandomSeed'] = $_POST['RandomSeed7'];
        $item7['EnhanceLevel'] = $_POST['EnhanceLevel7'];
        $item7['Potential'] = $_POST['Potential7'];
        $item7['SoulBound'] = $_POST['SoulBound7'];
        $item7['Seals'] = $_POST['Seals7'];
        $item7['Option'] = $_POST['Option7'];
        $item7['Lifespan'] = $_POST['Lifespan7'];
        $item7['Eternal'] = $_POST['Eternity7'];
        $item7['JewelType'] = $_POST['JewelType7'];

        $item8['ItemID'] = $_POST['ItemID8'];
        $item8['ProductFlag'] = $_POST['ProductFlag8'];
        $item8['Count'] = $_POST['Count8'];
        $item8['Durability'] = $_POST['Durability8'];
        $item8['RandomSeed'] = $_POST['RandomSeed8'];
        $item8['EnhanceLevel'] = $_POST['EnhanceLevel8'];
        $item8['Potential'] = $_POST['Potential8'];
        $item8['SoulBound'] = $_POST['SoulBound8'];
        $item8['Seals'] = $_POST['Seals8'];
        $item8['Option'] = $_POST['Option8'];
        $item8['Lifespan'] = $_POST['Lifespan8'];
        $item8['Eternal'] = $_POST['Eternity8'];
        $item8['JewelType'] = $_POST['JewelType8'];

        $item9['ItemID'] = $_POST['ItemID9'];
        $item9['ProductFlag'] = $_POST['ProductFlag9'];
        $item9['Count'] = $_POST['Count9'];
        $item9['Durability'] = $_POST['Durability9'];
        $item9['RandomSeed'] = $_POST['RandomSeed9'];
        $item9['EnhanceLevel'] = $_POST['EnhanceLevel9'];
        $item9['Potential'] = $_POST['Potential9'];
        $item9['SoulBound'] = $_POST['SoulBound9'];
        $item9['Seals'] = $_POST['Seals9'];
        $item9['Option'] = $_POST['Option9'];
        $item9['Lifespan'] = $_POST['Lifespan9'];
        $item9['Eternal'] = $_POST['Eternity9'];
        $item9['JewelType'] = $_POST['JewelType9'];

        $item10['ItemID'] = $_POST['ItemID10'];
        $item10['ProductFlag'] = $_POST['ProductFlag10'];
        $item10['Count'] = $_POST['Count10'];
        $item10['Durability'] = $_POST['Durability10'];
        $item10['RandomSeed'] = $_POST['RandomSeed10'];
        $item10['EnhanceLevel'] = $_POST['EnhanceLevel10'];
        $item10['Potential'] = $_POST['Potential10'];
        $item10['SoulBound'] = $_POST['SoulBound10'];
        $item10['Seals'] = $_POST['Seals10'];
        $item10['Option'] = $_POST['Option10'];
        $item10['Lifespan'] = $_POST['Lifespan10'];
        $item10['Eternal'] = $_POST['Eternity10'];
        $item10['JewelType'] = $_POST['JewelType10'];

        //XMLs
        if ($myparams['TargetTypeCode'] == 2)
        {
            $myparams['AccountIDList'] = listToXML(listToArray($_POST['AccountIDList']),"Account","AccountID");
            $myparams['AccountNameList'] = listToXML(listToArray($_POST['AccountNameList']),"Account","AccountName");
            $myparams['CharacterIDList'] = null;
            $myparams['CharacterNameList'] = null;
        }
        else if ($myparams['TargetTypeCode'] == 4)
        {
            $myparams['AccountIDList'] = null;
            $myparams['AccountNameList'] = null;
            $myparams['CharacterIDList'] = listToXML(listToArray($_POST['CharacterIDList']),"Character","CharacterID");
            $myparams['CharacterNameList'] = listToXML(listToArray($_POST['CharacterNameList']),"Character","CharacterName");
        }
        else
        {
            $myparams['AccountIDList'] = null;
            $myparams['AccountNameList'] = null;
            $myparams['CharacterIDList'] = null;
            $myparams['CharacterNameList'] = null;
        }
        $myparams['EventRewardItemList'] = '<root>' 
                                            . itemToXML($item1)
                                            . itemToXML($item2)
                                            . itemToXML($item3)
                                            . itemToXML($item4)
                                            . itemToXML($item5)
                                            . itemToXML($item6)
                                            . itemToXML($item7)
                                            . itemToXML($item8)
                                            . itemToXML($item9)
                                            . itemToXML($item10)
                                            . '</root>';
        $myparams['EventRewardID'] = 0;

        // The following functions are based on bootstrap classes for error and success message. If you are not using bootstrap you can stylize your own.

        $sql = "SET ANSI_NULLS ON
        SET QUOTED_IDENTIFIER ON
        SET CONCAT_NULL_YIELDS_NULL ON
        SET ANSI_WARNINGS ON
        SET ANSI_PADDING ON
        EXEC P_DLS_AddEventReward 
        @inyReceiveTypeCode=?,@inyTargetTypeCode=?,@xmlAccountIDs=?,@xmlAccountNames=?,@xmlCharacterIDs=?,@xmlCharacterNames=?,@inyTargetWorldID=?,@inyTargetClassCode=?,@inyTargetMinLevel=?,@inyTargetMaxLevel=?,@sdtReserveSendDate=?,@sdtExpirationDate=?,@nvcEventName=?,@nvcSenderName=?,@nvcContent=?,@inbRewardCoin=?,@xmlEventRewardItems=?,@inyEventRewardTypeCode=?,@intEventRewardID=?

        ";

        $procedure_params = array(
            array(&$myparams['ReceiveTypeCode'], SQLSRV_PARAM_IN),
            array(&$myparams['TargetTypeCode'], SQLSRV_PARAM_IN),
            array(&$myparams['AccountIDList'], SQLSRV_PARAM_IN),
            array(&$myparams['AccountNameList'], SQLSRV_PARAM_IN),
            array(&$myparams['CharacterIDList'], SQLSRV_PARAM_IN),
            array(&$myparams['CharacterNameList'], SQLSRV_PARAM_IN),
            array(&$myparams['TargetWorldID'], SQLSRV_PARAM_IN),
            array(&$myparams['TargetClassCode'], SQLSRV_PARAM_IN),
            array(&$myparams['TargetMinLevel'], SQLSRV_PARAM_IN),
            array(&$myparams['TargetMaxLevel'], SQLSRV_PARAM_IN),
            array(&$myparams['ReserveSendDate'], SQLSRV_PARAM_IN),
            array(&$myparams['ExpirationDate'], SQLSRV_PARAM_IN),
            array(&$myparams['EventName'], SQLSRV_PARAM_IN),
            array(&$myparams['SenderName'], SQLSRV_PARAM_IN),
            array(&$myparams['Content'], SQLSRV_PARAM_IN),
            array(&$myparams['RewardCoin'], SQLSRV_PARAM_IN),
            array(&$myparams['EventRewardItemList'], SQLSRV_PARAM_IN),
            array(&$myparams['EventRewardTypeCode'], SQLSRV_PARAM_IN),
            array(&$myparams['EventRewardID'], SQLSRV_PARAM_OUT)
        );

        if( $stmt = sqlsrv_prepare( $conn, $sql, $procedure_params))
        {
            $statePrepare = true;
        } 
        else
        {
            $statePrepare = false;
        }

        if( sqlsrv_execute($stmt))
        {
            $stateExec = true;
        }
        else
        {
            $stateExec = false;
        }
    }
}
else
{
	header("Location: ../home");
    exit();
}
?>

			<div class = "pagebg1" class="wow fadeIn" data-wow-delay="1s" style="display: flex;justify-content: center;align-items: center;" >
				<form class="box" action="" method="post" enctype="multipart/form-data" autocomplete = "off">
					<h1>Send event rewards</h1>
				    <div class="footer-divider" style="margin-top:1%"></div>
				    <div class="container">
                        <!-- Ban Response -->
                        <?php error_reporting(0);
                        ini_set('display_errors', 0);
                        if( $_POST["Send"])
                        { 
                            $results = print_r($myparams,true);
                            echo '<span style="color:#AFA;"><center>Rewards Given !</span>';
                            echo '<span style="color:#AFA;"><center>Exec : ' . $stateExec . '</span>';
                            echo '<span style="color:#AFA;"><center>Prepare : ' . $statePrepare . '</span>';
                            echo '<span style="color:#AFA;"><center>' . htmlspecialchars($results) . '</span>';
                            echo '<span style="color:#AFA;"><center>' . print_r( sqlsrv_errors(), true) . '</span>';
                            
                            header("refresh:120;url=../admin/admincp"); 
                        } 
                        ?>
                        
                        <h3>Receive Type Code</h3>
                        <input type="number" name="ReceiveTypeCode" placeholder="1 : All items, 2 : Select one item" list="ReceiveTypeCodeCombo" required>
                        <datalist id="ReceiveTypeCodeCombo">
                            <option>1</option>
                            <option>2</option>
                        </datalist>
                            
                        <h3>Target Type Code</h3>
                        <input type="number" name="TargetTypeCode" placeholder="1 : All accounts, 2 : List of accounts, 3 : All characters, 4 : List of characters" list="TargetTypeCodeCombo" required>
                        <datalist id="TargetTypeCodeCombo">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </datalist>
                        
                        <h3>Account ID List</h3>
                        <input type="text" name="AccountIDList" placeholder="Format : 2408,2409,... Not necessary if Target Type Code is not 2 !">
                        
                        <h3>Account Name List</h3>
                        <input type="text" name="AccountNameList" placeholder="Format : account1,account2,... Not necessary if Target Type Code is not 2 !">
                        
                        <h3>Character ID List</h3>
                        <input type="text" name="CharacterIDList" placeholder="Format : 2408,2409,... Not necessary if Target Type Code is not 4 !">
                        
                        <h3>Character Name List</h3>
                        <input type="text" name="CharacterNameList" placeholder="Format : testchar1,testchar2,... Not necessary if Target Type Code is not 4 !">
                        
                        <h3>Target World ID</h3>
                        <input type="number" name="TargetWorldID" placeholder="World ID, should be 1 for us" value="1" required>

                        <h3>Target Class Code</h3>
                        <input type="number" name="TargetClassCode" placeholder="Allowed JobID. Leave empty for no class limit !">

                        <h3>Target Min Level</h3>
                        <input type="number" name="TargetMinLevel" placeholder="Minimum level allowed" value="1" required>

                        <h3>Target Max Level</h3>
                        <input type="number" name="TargetMaxLevel" placeholder="Maximum level allowed" value="40" required>

                        <h3>Send Date</h3>
                        <input type="datetime-local" name="ReserveSendDate" placeholder="When to send the reward" required>

                        <h3>Expiration Date</h3>
                        <input type="datetime-local" name="ExpirationDate" placeholder="When the reward expires" required>

                        <h3>Event Name</h3>
                        <input type="text" name="EventName" placeholder="Does not show in game" required>

                        <h3>Sender Name</h3>
                        <input type="text" name="SenderName" placeholder="Sender name to display" required>

                        <h3>Message Content</h3>
                        <input type="text" name="Content" placeholder="Message to display on the reward" required>

                        <h3>Gold Reward</h3>
                        <input type="number" name="RewardCoin" placeholder="Amount of coppers to give in the reward" required>

                        <h3>Event Reward Type Code</h3>
                        <input type="number" name="EventRewardTypeCode" placeholder="1 : GM , 2: system | Vahr thinks it's only for internal" required>

                        <h3>Item List</h3>
                        <div class = "item-list" id="itemForm">
                            <h4>Leave empty for no item !</h4>
                            <button class="itemButton" type="button" name="AddItemButton" onclick="AddItem()">Add Item</button>
                            <button class="itemButton" type="button" name="RemoveItemButton" onclick="RemoveItem()">Remove Item</button>
                            <div class="item-entry" id="DivItem1">
                                <h3>Item ID</h3>
                                <input type="number" name="ItemID1" placeholder="Enter ItemID">

                                <h3>Product Flag</h3>
                                <input type="number" name="ProductFlag1" placeholder="0 for False , 1 for True" list="ProductFlag1Combo">
                                <datalist id="ProductFlag1Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Count</h3>
                                <input type="number" name="Count1" placeholder="Count">

                                <h3>Durability</h3>
                                <input type="number" name="Durability1" placeholder="Durability">

                                <h3>Random Seed</h3>
                                <input type="number" name="RandomSeed1" placeholder="Random seed">

                                <h3>Enhance Level</h3>
                                <input type="number" name="EnhanceLevel1" placeholder="Enhance Level">

                                <h3>Potential</h3>
                                <input type="number" name="Potential1" placeholder="Potential">

                                <h3>Soul Bound</h3>
                                <input type="number" name="SoulBound1" placeholder="0 for False , 1 for True" list="SoulBound1Combo">
                                <datalist id="SoulBound1Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Seals</h3>
                                <input type="number" name="Seals1" placeholder="Seals">

                                <h3>Option</h3>
                                <input type="number" name="Option1" placeholder="Option">

                                <h3>Lifespan</h3>
                                <input type="number" name="Lifespan1" placeholder="Lifespan">

                                <h3>Eternity</h3>
                                <input type="number" name="Eternity1" placeholder="0 for False , 1 for True" list="Eternity1Combo">
                                <datalist id="Eternity1Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Jewel Type</h3>
                                <input type="number" name="JewelType1" placeholder="Jewel Type">
                            </div>
                            <div class="item-entry" id="DivItem2">
                                <h3>Item ID</h3>
                                <input type="number" name="ItemID2" placeholder="Enter ItemID">

                                <h3>Product Flag</h3>
                                <input type="number" name="ProductFlag2" placeholder="0 for False , 1 for True" list="ProductFlag2Combo">
                                <datalist id="ProductFlag2Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Count</h3>
                                <input type="number" name="Count2" placeholder="Count">

                                <h3>Durability</h3>
                                <input type="number" name="Durability2" placeholder="Durability">

                                <h3>Random Seed</h3>
                                <input type="number" name="RandomSeed2" placeholder="Random seed">

                                <h3>Enhance Level</h3>
                                <input type="number" name="EnhanceLevel2" placeholder="Enhance Level">

                                <h3>Potential</h3>
                                <input type="number" name="Potential2" placeholder="Potential">

                                <h3>Soul Bound</h3>
                                <input type="number" name="SoulBound2" placeholder="0 for False , 1 for True" list="SoulBound2Combo">
                                <datalist id="SoulBound2Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Seals</h3>
                                <input type="number" name="Seals2" placeholder="Seals">

                                <h3>Option</h3>
                                <input type="number" name="Option2" placeholder="Option">

                                <h3>Lifespan</h3>
                                <input type="number" name="Lifespan2" placeholder="Lifespan">

                                <h3>Eternity</h3>
                                <input type="number" name="Eternity2" placeholder="0 for False , 1 for True" list="Eternity2Combo">
                                <datalist id="Eternity2Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Jewel Type</h3>
                                <input type="number" name="JewelType2" placeholder="Jewel Type">
                            </div>
                            <div class="item-entry" id="DivItem3">
                                <h3>Item ID</h3>
                                <input type="number" name="ItemID3" placeholder="Enter ItemID">

                                <h3>Product Flag</h3>
                                <input type="number" name="ProductFlag3" placeholder="0 for False , 1 for True" list="ProductFlag3Combo">
                                <datalist id="ProductFlag3Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Count</h3>
                                <input type="number" name="Count3" placeholder="Count">

                                <h3>Durability</h3>
                                <input type="number" name="Durability3" placeholder="Durability">

                                <h3>Random Seed</h3>
                                <input type="number" name="RandomSeed3" placeholder="Random seed">

                                <h3>Enhance Level</h3>
                                <input type="number" name="EnhanceLevel3" placeholder="Enhance Level">

                                <h3>Potential</h3>
                                <input type="number" name="Potential3" placeholder="Potential">

                                <h3>Soul Bound</h3>
                                <input type="number" name="SoulBound3" placeholder="0 for False , 1 for True" list="SoulBound3Combo">
                                <datalist id="SoulBound3Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Seals</h3>
                                <input type="number" name="Seals3" placeholder="Seals">

                                <h3>Option</h3>
                                <input type="number" name="Option3" placeholder="Option">

                                <h3>Lifespan</h3>
                                <input type="number" name="Lifespan3" placeholder="Lifespan">

                                <h3>Eternity</h3>
                                <input type="number" name="Eternity3" placeholder="0 for False , 1 for True" list="Eternity3Combo">
                                <datalist id="Eternity3Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Jewel Type</h3>
                                <input type="number" name="JewelType3" placeholder="Jewel Type">
                            </div>
                            <div class="item-entry" id="DivItem4">
                                <h3>Item ID</h3>
                                <input type="number" name="ItemID4" placeholder="Enter ItemID">

                                <h3>Product Flag</h3>
                                <input type="number" name="ProductFlag4" placeholder="0 for False , 1 for True" list="ProductFlag4Combo">
                                <datalist id="ProductFlag4Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Count</h3>
                                <input type="number" name="Count4" placeholder="Count">

                                <h3>Durability</h3>
                                <input type="number" name="Durability4" placeholder="Durability">

                                <h3>Random Seed</h3>
                                <input type="number" name="RandomSeed4" placeholder="Random seed">

                                <h3>Enhance Level</h3>
                                <input type="number" name="EnhanceLevel4" placeholder="Enhance Level">

                                <h3>Potential</h3>
                                <input type="number" name="Potential4" placeholder="Potential">

                                <h3>Soul Bound</h3>
                                <input type="number" name="SoulBound4" placeholder="0 for False , 1 for True" list="SoulBound4Combo">
                                <datalist id="SoulBound4Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Seals</h3>
                                <input type="number" name="Seals4" placeholder="Seals">

                                <h3>Option</h3>
                                <input type="number" name="Option4" placeholder="Option">

                                <h3>Lifespan</h3>
                                <input type="number" name="Lifespan4" placeholder="Lifespan">

                                <h3>Eternity</h3>
                                <input type="number" name="Eternity4" placeholder="0 for False , 1 for True" list="Eternity4Combo">
                                <datalist id="Eternity4Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Jewel Type</h3>
                                <input type="number" name="JewelType4" placeholder="Jewel Type">
                            </div>
                            <div class="item-entry" id="DivItem5">
                                <h3>Item ID</h3>
                                <input type="number" name="ItemID5" placeholder="Enter ItemID">

                                <h3>Product Flag</h3>
                                <input type="number" name="ProductFlag5" placeholder="0 for False , 1 for True" list="ProductFlag5Combo">
                                <datalist id="ProductFlag5Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Count</h3>
                                <input type="number" name="Count5" placeholder="Count">

                                <h3>Durability</h3>
                                <input type="number" name="Durability5" placeholder="Durability">

                                <h3>Random Seed</h3>
                                <input type="number" name="RandomSeed5" placeholder="Random seed">

                                <h3>Enhance Level</h3>
                                <input type="number" name="EnhanceLevel5" placeholder="Enhance Level">

                                <h3>Potential</h3>
                                <input type="number" name="Potential5" placeholder="Potential">

                                <h3>Soul Bound</h3>
                                <input type="number" name="SoulBound5" placeholder="0 for False , 1 for True" list="SoulBound5Combo">
                                <datalist id="SoulBound5Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Seals</h3>
                                <input type="number" name="Seals5" placeholder="Seals">

                                <h3>Option</h3>
                                <input type="number" name="Option5" placeholder="Option">

                                <h3>Lifespan</h3>
                                <input type="number" name="Lifespan5" placeholder="Lifespan">

                                <h3>Eternity</h3>
                                <input type="number" name="Eternity5" placeholder="0 for False , 1 for True" list="Eternity5Combo">
                                <datalist id="Eternity5Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Jewel Type</h3>
                                <input type="number" name="JewelType5" placeholder="Jewel Type">
                            </div>
                            <div class="item-entry" id="DivItem6">
                                <h3>Item ID</h3>
                                <input type="number" name="ItemID6" placeholder="Enter ItemID">

                                <h3>Product Flag</h3>
                                <input type="number" name="ProductFlag6" placeholder="0 for False , 1 for True" list="ProductFlag6Combo">
                                <datalist id="ProductFlag6Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Count</h3>
                                <input type="number" name="Count6" placeholder="Count">

                                <h3>Durability</h3>
                                <input type="number" name="Durability6" placeholder="Durability">

                                <h3>Random Seed</h3>
                                <input type="number" name="RandomSeed6" placeholder="Random seed">

                                <h3>Enhance Level</h3>
                                <input type="number" name="EnhanceLevel6" placeholder="Enhance Level">

                                <h3>Potential</h3>
                                <input type="number" name="Potential6" placeholder="Potential">

                                <h3>Soul Bound</h3>
                                <input type="number" name="SoulBound6" placeholder="0 for False , 1 for True" list="SoulBound6Combo">
                                <datalist id="SoulBound6Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Seals</h3>
                                <input type="number" name="Seals6" placeholder="Seals">

                                <h3>Option</h3>
                                <input type="number" name="Option6" placeholder="Option">

                                <h3>Lifespan</h3>
                                <input type="number" name="Lifespan6" placeholder="Lifespan">

                                <h3>Eternity</h3>
                                <input type="number" name="Eternity6" placeholder="0 for False , 1 for True" list="Eternity6Combo">
                                <datalist id="Eternity6Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Jewel Type</h3>
                                <input type="number" name="JewelType6" placeholder="Jewel Type">
                            </div>
                            <div class="item-entry" id="DivItem7">
                                <h3>Item ID</h3>
                                <input type="number" name="ItemID7" placeholder="Enter ItemID">

                                <h3>Product Flag</h3>
                                <input type="number" name="ProductFlag7" placeholder="0 for False , 1 for True" list="ProductFlag7Combo">
                                <datalist id="ProductFlag7Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Count</h3>
                                <input type="number" name="Count7" placeholder="Count">

                                <h3>Durability</h3>
                                <input type="number" name="Durability7" placeholder="Durability">

                                <h3>Random Seed</h3>
                                <input type="number" name="RandomSeed7" placeholder="Random seed">

                                <h3>Enhance Level</h3>
                                <input type="number" name="EnhanceLevel7" placeholder="Enhance Level">

                                <h3>Potential</h3>
                                <input type="number" name="Potential7" placeholder="Potential">

                                <h3>Soul Bound</h3>
                                <input type="number" name="SoulBound7" placeholder="0 for False , 1 for True" list="SoulBound7Combo">
                                <datalist id="SoulBound7Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Seals</h3>
                                <input type="number" name="Seals7" placeholder="Seals">

                                <h3>Option</h3>
                                <input type="number" name="Option7" placeholder="Option">

                                <h3>Lifespan</h3>
                                <input type="number" name="Lifespan7" placeholder="Lifespan">

                                <h3>Eternity</h3>
                                <input type="number" name="Eternity7" placeholder="0 for False , 1 for True" list="Eternity7Combo">
                                <datalist id="Eternity7Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Jewel Type</h3>
                                <input type="number" name="JewelType7" placeholder="Jewel Type">
                            </div>
                            <div class="item-entry" id="DivItem8">
                                <h3>Item ID</h3>
                                <input type="number" name="ItemID8" placeholder="Enter ItemID">

                                <h3>Product Flag</h3>
                                <input type="number" name="ProductFlag8" placeholder="0 for False , 1 for True" list="ProductFlag8Combo">
                                <datalist id="ProductFlag8Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Count</h3>
                                <input type="number" name="Count8" placeholder="Count">

                                <h3>Durability</h3>
                                <input type="number" name="Durability8" placeholder="Durability">

                                <h3>Random Seed</h3>
                                <input type="number" name="RandomSeed8" placeholder="Random seed">

                                <h3>Enhance Level</h3>
                                <input type="number" name="EnhanceLevel8" placeholder="Enhance Level">

                                <h3>Potential</h3>
                                <input type="number" name="Potential8" placeholder="Potential">

                                <h3>Soul Bound</h3>
                                <input type="number" name="SoulBound8" placeholder="0 for False , 1 for True" list="SoulBound8Combo">
                                <datalist id="SoulBound8Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Seals</h3>
                                <input type="number" name="Seals8" placeholder="Seals">

                                <h3>Option</h3>
                                <input type="number" name="Option8" placeholder="Option">

                                <h3>Lifespan</h3>
                                <input type="number" name="Lifespan8" placeholder="Lifespan">

                                <h3>Eternity</h3>
                                <input type="number" name="Eternity8" placeholder="0 for False , 1 for True" list="Eternity8Combo">
                                <datalist id="Eternity8Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Jewel Type</h3>
                                <input type="number" name="JewelType8" placeholder="Jewel Type">
                            </div>
                            <div class="item-entry" id="DivItem9">
                                <h3>Item ID</h3>
                                <input type="number" name="ItemID9" placeholder="Enter ItemID">

                                <h3>Product Flag</h3>
                                <input type="number" name="ProductFlag9" placeholder="0 for False , 1 for True" list="ProductFlag9Combo">
                                <datalist id="ProductFlag9Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Count</h3>
                                <input type="number" name="Count9" placeholder="Count">

                                <h3>Durability</h3>
                                <input type="number" name="Durability9" placeholder="Durability">

                                <h3>Random Seed</h3>
                                <input type="number" name="RandomSeed9" placeholder="Random seed">

                                <h3>Enhance Level</h3>
                                <input type="number" name="EnhanceLevel9" placeholder="Enhance Level">

                                <h3>Potential</h3>
                                <input type="number" name="Potential9" placeholder="Potential">

                                <h3>Soul Bound</h3>
                                <input type="number" name="SoulBound9" placeholder="0 for False , 1 for True" list="SoulBound9Combo">
                                <datalist id="SoulBound9Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Seals</h3>
                                <input type="number" name="Seals9" placeholder="Seals">

                                <h3>Option</h3>
                                <input type="number" name="Option9" placeholder="Option">

                                <h3>Lifespan</h3>
                                <input type="number" name="Lifespan9" placeholder="Lifespan">

                                <h3>Eternity</h3>
                                <input type="number" name="Eternity9" placeholder="0 for False , 1 for True" list="Eternity9Combo">
                                <datalist id="Eternity9Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Jewel Type</h3>
                                <input type="number" name="JewelType9" placeholder="Jewel Type">
                            </div>
                            <div class="item-entry" id="DivItem10">
                                <h3>Item ID</h3>
                                <input type="number" name="ItemID10" placeholder="Enter ItemID">

                                <h3>Product Flag</h3>
                                <input type="number" name="ProductFlag10" placeholder="0 for False , 1 for True" list="ProductFlag10Combo">
                                <datalist id="ProductFlag10Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Count</h3>
                                <input type="number" name="Count10" placeholder="Count">

                                <h3>Durability</h3>
                                <input type="number" name="Durability10" placeholder="Durability">

                                <h3>Random Seed</h3>
                                <input type="number" name="RandomSeed10" placeholder="Random seed">

                                <h3>Enhance Level</h3>
                                <input type="number" name="EnhanceLevel10" placeholder="Enhance Level">

                                <h3>Potential</h3>
                                <input type="number" name="Potential10" placeholder="Potential">

                                <h3>Soul Bound</h3>
                                <input type="number" name="SoulBound10" placeholder="0 for False , 1 for True" list="SoulBound10Combo">
                                <datalist id="SoulBound10Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Seals</h3>
                                <input type="number" name="Seals10" placeholder="Seals">

                                <h3>Option</h3>
                                <input type="number" name="Option10" placeholder="Option">

                                <h3>Lifespan</h3>
                                <input type="number" name="Lifespan10" placeholder="Lifespan">

                                <h3>Eternity</h3>
                                <input type="number" name="Eternity10" placeholder="0 for False , 1 for True" list="Eternity10Combo">
                                <datalist id="Eternity10Combo">
                                    <option>0</option>
                                    <option>1</option>
                                </datalist>

                                <h3>Jewel Type</h3>
                                <input type="number" name="JewelType10" placeholder="Jewel Type">
                            </div>
                        </div>

                        <input type="submit" value="Send" name = "Send">
                        <button data-dismiss="modal" type ="CANCEL" class="cncl">Cancel</button>
				</form>
			</div>
			


<style type="text/css">

	.modal-content {background: transparent;}
	.box{


 min-height: 1000px;
    
	
	}
	.box h1{
		color: white;
		text-transform: uppercase;
		font-weight: 750;
		font-size: 25px;
		margin-top: 15%;
		text-align: center;
		text-transform:uppercase; 
		text-shadow: 0px 0px 9px white;
	}
	.box h2{
		color: white;
		text-transform: uppercase;
		font-weight: 500;
		font-size: 15px;
		margin-top: 1%;
		text-align: center;
	}
		.box h3{
		color: white;
		text-transform: uppercase;
		font-weight: 500;
		font-size: 15px;
		margin-top: 0%;
		text-align: center;
	}
	.box input[type = "text"],.box input[type = "password"],.box input[type = "text"],.box input[type = "number"]{
		border:0;
		background: rgba(0, 0, 0, 0.3);
		display: block;
		margin: 2px auto 20px;
		text-align: center;
		border: 1px solid gold;
		padding: 8px 0px;
		width: 50%;
		outline: none;
		color: white;
		transition: 0.25s;
	}
    .box input[type = "datetime-local"]{
		border:0;
		background: rgba(255, 255, 255, 1);
		display: block;
		margin: 2px auto 20px;
		text-align: center;
		border: 1px solid gold;
		padding: 8px 0px;
		width: 50%;
		outline: none;
		color: black;
		transition: 0.25s;
	}
	.box input[type = "text"]:focus,.box input[type = "password"]:focus,.box input[type = "text"]:focus,.box input[type = "number"]:focus,.box input[type = "datetime-local"]:focus{

		border-color: orange;
	}
	.box input[type = "submit"]{
		border:0;
		background: rgba(0, 0, 0, 0.3);
		display: block;
		margin: 20px auto;
		text-align: center;
		border: 1px solid cyan;
		padding: 8px 10px;
		width: 50%;
		outline: none;
		color: white;
		transition: 0.25s;
		display: block;
		text-transform: uppercase;
	}
    .itemButton{
		border:0;
		background: rgba(0, 0, 0, 0.3);
		display: block;
		margin: 20px auto;
		text-align: center;
		border: 1px solid cyan;
		padding: 8px 10px 10px;
		width: 50%;
		outline: none;
		color: white;
		transition: 0.25s;
		display: block;
		text-transform: uppercase;
	}
	.box input[type = "submit"]:hover{
		background: rgba(0, 0, 0, 0.7);
		color: black;
	}
	
	.cncl {
		border:0;
		background: rgba(0, 0, 0, 0.1);
		display: block;
		margin: 20px auto 0;
		text-align: center;
		text-transform: uppercase;
		padding: 10px 10px;
		width: 50%;
		outline: none;
		color: grey;
		transition: 0.25s;
		display: block;
		border: 1px solid grey;
	}
	.cncl:hover {
		background: rgba(0, 0, 0, 0.7);
		color: black;}
	.box label {margin:0px;padding: 0px;color: white;text-align: left !important;text-transform: uppercase; font-size: 13px;}

    .item-list
    {
        border:0;
		background: rgba(0, 0, 0, 0.3);
		display: block;
		margin: 2px auto 20px;
		text-align: center;
		border: 1px solid gold;
		padding: 8px 0px;
		width: 50%;
		outline: none;
		color: white;
		transition: 0.25s;
    }
    .item-entry
    {
        border:0;
		background: rgba(0, 0, 0, 0.3);
		display: none;
		margin: 2px auto 20px;
		text-align: center;
		border: 1px solid gold;
		padding: 8px 0px;
		width: 90%;
		outline: none;
		color: white;
		transition: 0.25s;
    }
</style>


</body>
</html>

<?php include('headersub.php'); ?>