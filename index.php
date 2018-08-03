<?php

$base_system_from = 4;
$base_system_to = 0;
$systems = array(2,3,4,8,10,12,16);

$start_number = filter_input(INPUT_POST, 'start_number');

if ( !empty($start_number) ) {
    $base_system_from = filter_input(INPUT_POST, 'base_system_from', FILTER_VALIDATE_INT);
    $base_system_to = filter_input(INPUT_POST, 'base_system_to', FILTER_VALIDATE_INT);
    if ( filter_var($start_number, FILTER_VALIDATE_INT, array('flags' => 'FILTER_FLAG_ALLOW_HEX')) ) {
        if ( $base_system_to == 6 ) {
            $output = '<span>'.dechex( base_convert($start_number, $systems[$base_system_from], 10) ).'</span>';
        } else {
            $output = '<span>'.base_convert($start_number, $systems[$base_system_from], $systems[$base_system_to]).'</span>';
        }
    } else {
        $output = 'Hey! Put a number in there!';
    }
} else {
    $output = $start_number = '';
}

$systems = array(
    '2 (Binary)',
    '3',
    '4',
    '8',
    '10 (Human-readable)',
    '12',
    '16 (Hexadecimal)'
);

?>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Base Convert</title>
    <style>
        body { background: #e5efff; padding: 24px; font-family: 'Arial', serif; line-height: 1.5; }
        .site-container .wrap { width: 280px; margin: 0 auto; text-align: center; }
        h1 { font-size: 30px; }
        label { font-size: .8em; }
        select, input { font-size: 18px; width: 100%; margin: 4px 0 12px; border-radius: 4px; border: 1px #141414 solid; padding: 16px; }
        input[type="submit"] { background: #141414; color: #fff; cursor: pointer; }
        input[type="submit"]:hover { background: #bbb; }
        span { letter-spacing: 1px; font-family: "Courier New", Courier, monospace; font-weight: 700; }
    </style>
</head>
<body style="">
<div class="site-container">
    <h1 style="text-align:center">Base Convert</h1>
    <div class="wrap">
        <form action="" method="post">
            <div>
                <label for="base_system_from">Starting Number System</label>
                <select name="base_system_from" id="base_system_from" >
                <?php foreach ( $systems as $key => $system ): ?>
                    <option value="<?php echo $key ?>" <?php echo ( $base_system_from == $key ? 'selected' : '' ) ?> ><?php echo $system ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="base_system_to">Result Number System</label>
                <select name="base_system_to" id="base_system_to" >
                <?php foreach ( $systems as $key => $system ): ?>
                    <option value="<?php echo $key ?>" <?php echo ( $base_system_to == $key ? 'selected' : '' ) ?> ><?php echo $system ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="start_number">Number</label>
                <input type="text" name="start_number" id="start_number" value="<?php echo $start_number ?>" />
            </div>
            <input type="submit" value="Convert!" />
        </form>
        <div><?php echo $output; ?></div>
    </div>
</div>
</body>
</html>