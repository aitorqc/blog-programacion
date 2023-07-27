<?php
function first_paragraph($post_content)
{
    // Convertir la cadena de texto a un objeto DOMDocument
    $dom = new DOMDocument('1.0', 'UTF-8');
$dom->loadHTML('<?xml encoding="UTF-8">' . $post_content);

    // Obtener todos los elementos <p> (párrafos)
    $paragraphs = $dom->getElementsByTagName('p');

    // Verificar si hay al menos un párrafo
    if ($paragraphs->length > 0) {
        // Obtener el primer párrafo
        $primerParrafo = $paragraphs->item(0)->nodeValue;

        // Imprimir el contenido del primer párrafo
        return $primerParrafo;
    } else {
        // Si no hay párrafos en la cadena de texto
        echo "No se encontraron párrafos.";
    }
}
