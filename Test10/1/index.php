<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 3/17/16
 * Time: 1:21 PM
 */
error_reporting(E_ALL);
$source_array=array(0,1,2,3,4,5,6,7,8,9,10);
$row_count=round(ceil(count($source_array)/7));
?>
<head>
    <title>Test task 1</title>
    <meta charset="UTF-8">
</head>
<body>
  <div>
      <table border="1">
          <?php for($i=0;$i<$row_count;$i++): ?>
              <tr>
              <?php for($j=0;$j<7;$j++): ?>
                <td>
                    <?php
                      if ($i==0)
                          $index=$j;
                      else
                          $index=$j+(7*$i);
                    ?>
                    <?php if (isset($source_array[$index])): ?>
                      <?=$source_array[$index] ?>
                    <?php endif; ?>
                </td>
              <?php endfor; ?>
              </tr>
          <?php endfor; ?>
      </table>
  </div>
</body>