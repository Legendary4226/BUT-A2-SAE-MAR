<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Informations</title>
</head>
<body>
    <h1>Account</h1>
    <div>
        <p>User name: <?= $_SESSION['user_name'] ?></p>
        <p>User email: <?= $_SESSION['user_email'] ?></p>
    </div>

    <h1>Spaces</h1>
    <?
    ob_start();

    foreach($spaces as $space) { ?>
    <div class="all-spaces">
        <h2>Space - <?= $space->getName() ?></h2>
        <div class="space-boxes">
            <h3>Boxes</h3>
            <? foreach($all_boxes[$space->getId()] as $box) { ?>
                
                <h4>Box - <?= $box->getName() ?></h4>
                <div class="space-boxes">
                    <h5>Element</h5>
                    <? foreach($all_elements[$box->getId()] as $element) { ?>
                        <div>
                            <?
                            switch($element->getType()) {
                                case "note":
                                    break;
                                case "task":

                                    break;
                                default:
                                    echo json_encode($element->getContent());
                            }
                            ?>
                            <p> <?= json_encode($element->getContent()); ?></p>
                            <p><?= $element->getType() ?></p>
                        </div>
                    <? } ?>
                </div>
            <?  
            if (!empty($all_sharings[$space->getId()])){ ?>
                <h2>Sharings</h2>
                    <div>
                        <h3>User shared</h3>
                        <!-- foreach share -->
                        <p>Email : <?= var_dump($all_sharings[$space->getId()]);?></p>
                        <p>User permission </p>
                    </div>
                </div>
            <? }
            } ?>
    
            
        

    </div>
    <? }
    ob_end_flush();
    ?>





</body>
</html>