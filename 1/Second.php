<?php

class Second extends First {
    // Метод getClassname() не нужно определять, он унаследован от класса First
    public function getLetter(){
        echo "B";
    }
}
