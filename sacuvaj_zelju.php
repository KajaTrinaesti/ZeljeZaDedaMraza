<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        isset($_POST['ime']) ? $ime = $_POST['ime'] : $ime = '';
        isset($_POST['prezime']) ? $prezime = $_POST['prezime'] : $prezime = '';
        isset($_POST['grad']) ? $grad = $_POST['grad'] : $grad = '';
        isset($_POST['dobri']) ? $dobri = 'DA' : $dobri = 'NE';
        isset($_POST['zelja']) ? $zelja = $_POST['zelja'] : $zelja = '';


        if(!$ime) {
            header("Location: ./index.html"); 
            exit();
        }

        if(!$prezime) {
            header("Location: ./index.html"); 
            exit();
        }


        if(!$zelja) {
            header("Location: ./index.html"); 
            exit();
        }

        $gradovi = [
            'Andrijevica',
            'Bar',
            'Berane',
            'Bijelo Polje',
            'Budva',
            'Cetinje',
            'Danilovgrad',
            'Herceg Novi',
            'Kolasin',
            'Kotor',
            'Mojkovac',
            'Niksic',
            'Plav',
            'Pluzine',
            'Pljevlja',
            'Podgorica',
            'Rozaje',
            'Savnik',
            'Tivat',
            'Ulcinj',
            'Zabljak'
        ];

        if(!in_array($grad, $gradovi)) {
            header("Location: ./index.html"); 
            exit();
        }

        $slova = 'qwertyuiopšđžćčlkjhgfdsazxcvbnmQWERTYUIOPŠĐŽĆČLKJHGFDSAZXCVBNM';
        for($i = 0; $i < strlen($ime); $i++) {
            if(!strpos($slova, $ime[$i])) {
                header("Location: ./index.html"); 
                exit();
            }
        }

        for($i = 0; $i < strlen($prezime); $i++) {
            if(!strpos($slova, $prezime[$i])) {
                header("Location: ./index.html"); 
                exit();
            }
        }
        

        $zaJsonArr = ["Ime" => $ime, "Prezime" => $prezime, "Grad" => $grad, "Dobri" => $dobri, "Zelja" => $zelja];

        $json_encoded = json_encode($zaJsonArr, JSON_UNESCAPED_UNICODE);

        $folder_path = "./zelje_db";
        
        if(!file_exists($folder_path)) {
            mkdir($folder_path);
        }

        $unique_id = uniqid();

        $file = "$folder_path/$unique_id.txt";

        $handler = fopen($file, "a+");


        fputs($handler, $json_encoded);
        fclose($handler);
        header("Location: ./zelja_poslata.html");
    } else {
        echo 'Nepravilan metod!';
    }
?>