<?PHP

load_class('FileTree');
$tree = new FileTree();

//$tree->print_tree();

echo "<!doctype html>
<html>
<head>
	<meta chrset=\"UTF-8\">
	<title>Andrzej Dąbski.pl</title>
</head>
<body bgcolor=\"black\" text=\"lightgreen\" >";

foreach($tree->get_files() as $file){
	echo "<fieldset>
	<legend><b>{$file->get_name()}</b></legend>
	   <table>";

	foreach($file->get_files() as $file2){	  
	  echo "<tr><td> <a href=\"{$file2->get_url()}\"><img src=\"{$file2->get_pic_url()}\" width=150px ></a><font color=\"black\"> --- </font> </td> <td> <a href=\"{$file2->get_url()}\"><b>{$file2->get_name()}</b></a> </td></tr>";
	}
	echo "</table><!-- Dodać  blokowoścs na całej lini tabeli, żeby kliknąć gdziekolwiekss -->
	   </fieldset>";
}

echo "</body>
</html>";

?>
