<?PHP

        //Принимаем методом GET
        if (isset($_GET['id'])){
                $id = (int)$_GET['id'];
                //Выводим строку на основе id
                switch($id){
                                case 1:
                                        echo "<h1>Заголовок 1</h1>";
                                        break;
                                case 2:
                                        echo "<h2>Заголовок 2</h2>";
                                        break;
                                case 3:
                                        echo "<h3>Заголовок 3</h3>";
                                        break;                                  
                }               
        }
?>