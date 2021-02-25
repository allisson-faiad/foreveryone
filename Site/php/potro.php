

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-">
    <meta name="viewport" content="width=device-width, initial-scale=.">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
include "conecta_banco.php";

echo "<script>var a = confirm('Deseja fazer os cadastros?')
if(a == false){
    window.location = 'tela-inicial-voluntario.php';
}
else{ ";
    // verifica se quer cadastrar formacao
    echo "var b = confirm('Deseja fazer o cadastro de Formacao?')
    if(b == true){
    ";
    $dadosFormacao = array('Administração',
'Agronomia',
'Arqueologia',
'Alimentos',
'Análise-e-Desenvolvimento-de-Sistemas',
'Análises-Clínicas',
'Antropologia',
'Arquologia',
'Arquitetura-e-Urbanismo',
'Arquivologia',
'Artes',
'Artes-Cênicas',
'Artes-Gráficas',
'Artes-Plástica',
'Artes-Visuais',
'Biblioteconomia',
'Biomedicina',
'Ciência-da-Computação',
'Ciências-Biológicas',
'Ciências-Atuariais',
'Ciências-Contábeis',
'Ciências-Econômicas',
'Ciências-Naturais',
'Ciências-Sociais',
'Cinema-e-Audiovisual',
'Dança',
'Design',
'Direito',
'Educação-Física',
'Enfermagem',
'Engenharia-Aeronáutica',
'Engenharia-Agrícola',
'Engenharia-Ambiental-e-Sanitária',
'Engenharia-Cartográfica-e-de-Agrimensura',
'Engenharia-Civil',
'Engenharia-de-Alimentos',
'Engenharia-de-Bioprocessos',
'Engenharia-de-Computação',
'Engenharia-de-Controle-e-Automação',
'Engenharia-de-Materiais',
'Engenharia-de-Minas',
'Engenharia-de-Pesca',
'Engenharia-de-Petróleo',
'Engenharia-de-Produção',
'Engenharia-de-Telecomunicações',
'Engenharia-Elétrica',
'Engenharia-Eletrônica',
'Engenharia-Florestal',
'Engenharia-Mecânica',
'Engenharia-Metalúrgica',
'Engenharia-Naval',
'Engenharia-Nuclear',
'Engenharia-Química',
'Engenharia-Têxtil',
'Estatística',
'Farmácia',
'Filosofia',
'Física',
'Fisioterapia',
'Fonoaudiologia',
'Geografia',
'Geologia',
'História',
'Informática',
'Jornalismo',
'Letras-Língua-Estrangeira',
'Letras-Língua-Portuguesa',
'Matemática',
'Medicina',
'Medicina-Veterinária',
'Meteorologia',
'Museologia',
'Música',
'Nutrição',
'Odontologia',
'Pedagogia',
'Psicologia',
'Publicidade-e-Propaganda',
'Química',
'Radio,-TV,-Internet',
'Relações-Internacionais',
'Relações-Públicas',
'Secretariado-Executivo',
'Serviço-Social',
'Sistemas-da-Informação',
'Teatro',
'Teologia',
'Terapia-Ocupacional',
'Turismo',
'Zootecnia');




foreach($dadosFormacao as $kk){
    $insert = $con->query("INSERT INTO tb_formacao (nm_formacao) VALUES ('$kk') ");
}

echo "}"; // terminando cadastro da formacao
echo "else window.location = 'tela-inicial-voluntario.php'; ";


// verifica se quer cadastrar hablidade
echo "var c = confirm('Deseja fazer o cadastro de Habilidade?')
if(c == true){
";
$dadosHabilidade = array(
'Artes/Trabalho Manual',
'Comunicação',
'Dança/Música',
'Direito',
'Educação',
'Esportes',
'Cozinha',
'Gerenciamento',
'Idiomas',
'Computadores/Tecnologia',
'Saúde',
'Organização',
'Agilidade',
'Outros');


foreach($dadosHabilidade as $kk2){
$insert = $con->query("INSERT INTO tb_habilidade (nm_habilidade) VALUES ('$kk2') ");
}

echo "}";// terminando cadastro da habilidade
echo "else window.location = 'tela-inicial-voluntario.php'; ";
echo "}";
?>
    </select>
</body>
</html>