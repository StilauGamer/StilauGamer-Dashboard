<?php

function getThemeColor($themeid, $colorName, $type) {
    include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
    if (!$type == "rgb") {
        if ($stmt = $conn->prepare("SELECT * FROM themes WHERE theme_id=:theme_id")) {
            $stmt->bindParam(":theme_id", $themeid);
            $stmt->execute();
            $result = $stmt->fetch();
            switch ($colorName) {
                case "background-color":
                    return $result["background-color"];
                    break;
                case "main-color":
                    return $result["main-color"];
                    break;
                case "box-color":
                    return $result["box-color"];
                    break;
                case "text-color":
                    return $result["text-color"];
                    break;
                case "line-color":
                    return $result["line-color"];
                    break;
                default:
                    return "#FFFFFF";
                    break;
            }
        }
    }
    if ($stmt = $conn->prepare("SELECT * FROM themes WHERE theme_id=:theme_id")) {
        $stmt->bindParam(":theme_id", $themeid);
        $stmt->execute();
        $result = $stmt->fetch();
        switch ($colorName) {
            case "background-color":
                return $result["background-color"];
                break;
            case "main-color":
                return $result["main-color"];
                break;
            case "box-color":
                return $result["box-color"];
                break;
            case "text-color":
                return $result["text-color"];
                break;
            default:
                return "#FFFFFF";
                break;
        }
    }
}

?>