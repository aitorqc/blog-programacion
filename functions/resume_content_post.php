<?php
function first_paragraph($post_content)
{
    // Convertir caracteres especiales en entidades HTML
    $post_content = htmlspecialchars($post_content, ENT_QUOTES, 'UTF-8');

    // Crear un nuevo DOMDocument
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->loadHTML('<?xml encoding="UTF-8">' . $post_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    // Obtener todos los párrafos
    $paragraphs = $dom->getElementsByTagName('p');

    if ($paragraphs->length > 0) {
        // Concatenar el contenido de los párrafos en un solo texto
        $content = '';
        foreach ($paragraphs as $paragraph) {
            $content .= $paragraph->nodeValue . ' ';
        }

        // Eliminar los estilos restantes y obtener las primeras 50 palabras
        $cleaned_content = strip_tags($content);
        $words = preg_split('/\s+/u', $cleaned_content, -1, PREG_SPLIT_NO_EMPTY);
        $primeras_50_palabras = array_slice($words, 0, 50);
        
        // Unir las palabras en un solo texto
        $primerParrafo = implode(' ', $primeras_50_palabras);

        return $primerParrafo;
    } else {
        return "No se encontraron párrafos.";
    }
}
