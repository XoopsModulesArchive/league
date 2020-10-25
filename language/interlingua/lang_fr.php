<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?

//AVERTISSEMENT EN PAGE D'ADMINISTRATION
define(
    AVERTISSEMENT,
    "RAPPEL : PhpLeague 0.71 es un script en desarrollo

La plupart des opérations de suppressions n'effectuent aucun contrôle

sur le reste des données enregistrées.
Faites donc très attention si vous supprimez des données ..."
);

// ENTREES DU MENU ADMINISTRATION
define("SOUS_TITRE", "Administracion de tablas");
define("SEASON", "Temporadas");
define("CLUB", "Clubs");
define("DIVISION", "Divisiones");
define("LEAGUE", "Campeonatos");
define("TEAM", "Equipos");
define("CALENDAR", "Calendarios");
define("DATE", "Fechas");
define("MATCH", "Partidos");
define("COHERENCE", "Coherencia");
define("RESULT", "Resultados");
define("JOUEUR", "Jugadores");
define("BUTEUR", "Goleadores");
define("TAP_VERT", "Sanciones");
define("PARAMETRE", "Parametros");
define("CONSULT", "CONSULTAS");

// FICHIER admin/saisons.php
define("ADMIN_SAISON_TITRE", "Edicion de temporadas");
define("ADMIN_SAISON_SUPP1", "Eliminar temporada");
define("ADMIN_SAISON_SUPP2", "Eliminar temporada");
define("ADMIN_SAISON_BUTTON_SUPP", "Eliminar temporada");
define(
    "ADMIN_SAISON_MSG1",
    "Supprimer une saison, c'est aussi effacer
l'ensemble des rencontres attachées !!!"
);
define("ADMIN_SAISON_CREA", "CREAR una temporada");
define("ADMIN_SAISON_MSG2", "Primer año de la temporada: ");
define("ADMIN_SAISON_BUTTON_CREA", "Crear temporada");
define(
    "ADMIN_SAISON_BUTTON_MSG3",
    "Para modificar una temporada, utilice
PHPMyAdmin"
);
define("ADMIN_CRESAISON_MSG1", "Creacion efectuada ");
define("ADMIN_SUPPSAISON_MSG1", "Eliminacion efectuada");

// FICHERO admin/clubs.php
define("ADMIN_CLUB_TITRE", "Edicion de clubs");
define("ADMIN_CLUB_SUPP1", "Eliminar un club ");
define("ADMIN_CLUB_BUTTON_SUPP", "Eliminar club");
define("ADMIN_CLUB_CREA", "Ajout d'un club");
define("ADMIN_CLUB_NOM", "Nombre del club: ");
define("ADMIN_CLUB_BUTTON_CREA", "Crear club");
define(
    "ADMIN_CLUB_BUTTON_MSG3",
    "Para modificar el nombre de un club, utilice
PHPMyAdmin"
);

// Admin/divisions.php
define("ADMIN_DIVISION_TITRE", "Edicion de divisiones");
define("ADMIN_DIVISION_BUTTON_CREA", "Creacion de una division");
define("ADMIN_DIVISION_MSG1", "Divisiones existentes : ");

// admin/championnats.php
define("ADMIN_CHAMPIONNATS_TITRE", "Edicion de campeonatos");
define("ADMIN_CHAMPIONNATS_SUPP", "ELIMINAR un campeonato");
define("ADMIN_CHAMPIONNATS_BUTTON_SUPP", "Eliminar");
define("ADMIN_CHAMPIONNATS_CREA", "Creacion de un campeonato");
define("ADMIN_CHAMPIONNATS_MSG1", "Elija la division ? ");
define("ADMIN_CHAMPIONNATS_MSG2", "Elija la temporada ? ");
define("ADMIN_CHAMPIONNATS_BUTTON_CREA", "Crear");
define(
    "ADMIN_CHAMPIONNATS_BUTTON_MSG3",
    "Para modificar un equipo, utilice
PHPMyAdmin"
);

// admin/equipes.php
define("ADMIN_EQUIPE_TITRE", "Edicion de equipos");
define(
    "ADMIN_EQUIPE_MSG1",
    "Eliminar uno o varios equipos (Eleccion multiple
es posible pulsando SHIFT o CTRL) "
);
define("ADMIN_EQUIPE_MSG2", "Equipo que desea eliminar: ");
define(
    "ADMIN_EQUIPE_MSG3",
    "Inscribir (Eleccion multiple es posible pulsando
SHIFT o CTRL) "
);
define("ADMIN_EQUIPE_MSG4", " en ");
define(
    "ADMIN_EQUIPE_MSG5",
    "Para modificar un equipo, utilice PHPMyAdmin
"
);

// admin/journees.php
define("ADMIN_JOURNEES_TITRE", "Creacion de jornadas (calendrier)");
define(
    "ADMIN_JOURNEES_MSG1",
    "Elija el Nº de campeonato para el cual desea
crear un calendario, pase el control de coherencia !!! "
);
define("ADMIN_JOURNEES_MSG2", "Para que campeonato ?");
define("ADMIN_JOURNEES_MSG3", "temporada");
define("ADMIN_JOURNEES_MSG4", " equipos solo");
define("ADMIN_JOURNEES_MSG5", " jornadas");
define("ADMIN_JOURNEES_MSG6", "SI");
define("ADMIN_JOURNEES_MSG7", "NO");
define("ADMIN_JOURNEES_MSG8", "fechas previstas de cada jornada :");
define("ADMIN_JOURNEES_MSG9", "Jornada Nº ");
define("ADMIN_JOURNEES_MSG10", " son de la forma DDMMAAAA");
define("ADMIN_JOURNEES_MSG11", " equipos enfrentados");

// admin/dates.php
define("ADMIN_DATES_TITRE", "Actualizar las fechas de la jornada");
define("ADMIN_DATES_MSG1", "Que campeonato quiere actualizar ?");
define("ENVOI", "Envoi");

// admin/partidos
define("ADMIN_MATCHS_TITRE", "Edicion de Partidos");
define("ADMIN_MATCHS_MSG1", "Que campeonato quiere actualizar ? ");
define("ADMIN_MATCHS_MSG2", "Que jornada quiere actualizar ?");
define(
    "ADMIN_MATCHS_MSG3",
    "Atencion, debe efectuar el control de coherencia
..."
);
define("DOMICILE", "Local");
define("EXTERIEUR", "Visitante");
define("ADMIN_MATCHS_MSG4", "Jornada siguiente : ");

// Coherencia
define("ADMIN_COHERENCE_TITRE", " Controlar la coherencia de un campeonato");
define("ADMIN_COHERENCE_MSG1", "Que calendario quiere verificar ? ");
define("ADMIN_COHERENCE_MSG2", "Jornada ");
define("ADMIN_COHERENCE_MSG3", " coherente");
define("ADMIN_COHERENCE_MSG4", "incoherente o incompleto");
define("ADMIN_COHERENCE_MSG5", "El campeonato parece coherente");
define("ADMIN_COHERENCE_MSG6", "El campeonato parece incoherente");

// Resultados
define("ADMIN_RESULTATS_TITRE", "Edicion de resultados");
define("ADMIN_RESULTATS_MSG1", "Que campeonato quiere actualizar ?");
define("ADMIN_RESULTATS_MSG2", "Que jornada quiere actualizar ?");

// Sanciones
define("ADMIN_TAPVERT_TITRE", "Sanciones");
define(
    "ADMIN_TAPVERT_MSG1",
    "Ici, vous pouvez gérer les points de pénalité
(sanciones administrativas, forfaits, etc ...)"
);
define("ADMIN_TAPVERT_MSG2", "Que campeonato ?");
define(
    "ADMIN_TAPVERT_MSG3",
    "Introduzca los puntos de sancion (Ex: -1, -2,
...)"
);

// Parametros
define("ADMIN_PARAM_TITRE", "Parametros del campeonato");
define(
    "ADMIN_PARAM_MSG1",
    "Para que campeonato quiere establecer los
parametros ?"
);
define("ADMIN_PARAM_MSG2", "Puntos por partido ganado ? : ");
define("ADMIN_PARAM_MSG3", "Puntos por partido empatado ? :");
define("ADMIN_PARAM_MSG4", "Puntos por partido perdido ? :");
define("ADMIN_PARAM_MSG5", "Numero de equipos para el accenso directo ? : ");
define("ADMIN_PARAM_MSG6", "Numero de equipos para la promocion ? :");
define("ADMIN_PARAM_MSG7", "Numero de equipos para el descenso ? : ");
define("ADMIN_PARAM_MSG8", "Su equipo favorito ?");
define("ADMIN_PARAM_MSG9", "Registrar parametros");

/* ZONA PUBLICA : CONSULTAS */

// Cabecera del index
define("CONSULT_HOME", "Actual");
define("CONSULT_CALENDAR", "Calendarios");
define("CONSULT_CLASSEMENT", "Clasificaciones");
define("CONSULT_BUTEUR", "Goleadores");
define("CONSULT_DUEL", "Duelos");
define("MENU_UTILISATEUR", "Menu Principal");

//Clasificacion
define("CONSULT_CLMNT_MSG1", "Tipo de clasificacion :");
define("GENERAL", "General");
define("DOMICILE", "Local");
define("EXTERIEUR", "Visitante");
define("ATTAQUE", "Ataque");
define("DEFENSE", "Defensa");
define("GOALDIFF", "Dif");
define("CONSULT_CLMNT_MSG2", " de la jornada ");
define("CONSULT_CLMNT_MSG3", " a la jornada ");
define("CONSULT_CLMNT_MSG4", "Clasificacion general, jornadas ");
define("CONSULT_CLMNT_MSG5", " a ");
define("CONSULT_CLMNT_MSG6", "Ultimos Resultados : Jornada N°");
define(
    "CONSULT_CLMNT_MSG7",
    "ESTIMACION DE RESULTADOS DE LA PROXIMA JORNADA
:"
);
define(
    "CONSULT_CLMNT_MSG8",
    "PROBABILIDAD calculada de la 
proxima jornada : N° "
);
define("CONSULT_CLMNT_MSG9", "Prochaine journée : N° ");
define("CONSULT_CLMNT_MSG10", "Clasificacion jugados en casa, jornadas ");
define("CONSULT_CLMNT_MSG11", "Clasificacion mejores ataques, jornadas ");
define("CONSULT_CLMNT_MSG12", "Clasificacion mejores defensas, jornadas ");
define("CONSULT_CLMNT_MSG13", "Clasificacion Gol Average, journées ");
define("CONSULT_CLMNT_MSG14", "Clasificacion jugados fuera, jornadas ");
define("CLMNT_POSITION", "Pos");
define("CLMNT_EQUIPE", "Equipo");
define("CLMNT_POINTS", "Puntos");
define("CLMNT_JOUES", " J ");
define("CLMNT_VICTOIRES", "G ");
define("CLMNT_NULS", "E ");
define("CLMNT_DEFAITES", "P ");
define("CLMNT_BUTSPOUR", "GF ");
define("CLMNT_BUTSCONTRE", "GC ");
define("CLMNT_DIFF", "Dif. ");
define("EXEMPT", "Descansa");

// Matchs
define("CONSULT_MATCHS", "Consulta de los calendarios");
define("CONSULT_MATCHS_MSG1", "Que campeonato quiere consultar ?");
define("CONSULT_MATCHS_MSG2", " el ");

// Detalle del equipo

define("VICTOIRE", "VICTORIA ");
define("NUL", " EMPATE ");
define("DEFAITE", " DERROTA");

define("GRAFIC", " Grafico");
define("LOGO", " Logo");

?>
