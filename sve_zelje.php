<?php

    $folder_path = "./zelje_db";

    $dir = scandir($folder_path);

    echo "<style>
            body {
                display: flex; 
                width: 100%; 
                min-height: 100vh; 
                align-items: center; 
                justify-content: center;
            }

            table {
                border: 1px solid #ccc;
                border-spacing: 0;
                width: 80%;
            }

            table th {
                font-weight: 500;
            }

            table th, table td {
                border: 1px solid #ccc;
                padding: 10px;
                text-align: center;
            }
          </style>";

    $html = "<html><body><table><thead><tr><th>Ime</th><th>Prezime</th><th>Grad</th><th>Da li su bili dobri</th><th>Zelja</th></tr></thead><tbody>";
    
    if(count($dir) > 2) {
        for($i = 2; $i < count($dir); $i++) {
            $handler = fopen("$folder_path/".$dir[$i], "r");
            $json = fgets($handler);

            $data_arr = json_decode($json, true);
            
            $html .= "<tr><td>".$data_arr["Ime"]."</td><td>".$data_arr["Prezime"]."</td><td>".$data_arr["Grad"]."</td><td>".$data_arr["Dobri"]."</td><td>".$data_arr["Zelja"]."</td></tr>";

            fclose($handler);
        }
    }

    $html .= "</tbody></table></body></html>";

    echo $html;

?>