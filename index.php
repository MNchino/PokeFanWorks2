<!DOCTYPE html>
<html>
  <head>
    <meta  content="text/html; charset=utf-8"  http-equiv="content-type">
    <link  rel="stylesheet"  href="style.css">
	<script src="jquery-1.12.0.min.js"></script> <!-- jquery simplifies a lot of javascript. -->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>        <![endif]-->
    <title>Pokemon Fan Games</title>
  </head>
  <!--[if IE 6 ]><body class="ie6 old_ie"><![endif]-->
  <!--[if IE 7 ]><body class="ie7 old_ie"><![endif]-->
  <!--[if IE 8 ]><body class="ie8"><![endif]-->
  <!--[if IE 9 ]><body class="ie9"><![endif]-->
  <!--[if !IE]><!--><body><!--<![endif]-->
    <header  style="background-color: rgb(66, 66, 66);">
      <h1  style="text-align: left;">
	  <a  id="Title" class="main-font" style=" font-weight: bold;" style="font-family: Cambria; font-weight: bold;"

           href="index.html">PokéFanWorks</a></h1>
      <nav>
        <ul  style="position: fixed; right: 0; border: 0;">
          <li><a  href="index.php"  id="Title"  class="main-font" style=" font-weight: bold;"

               class="current">List</a></li>
          <li><a  href="contact.html"  class="main-font" style=" font-weight: bold;">Submit/Contact</a></li>
        </ul>
      </nav>
    </header>
    <h1 style="padding-top: 100px; text-align: center;" class="main-font">Pokémon
        Fan Game List</h1>
    <h3 style="text-align: center;" class="main-font">
        It's still incomplete</h3>
    <h6 style="text-align: center;" class="main-font">
        You can still add your game <a href="contact.html">here</a></h6>
		
	<div class="filter">
            <input name="filter" placeholder="Search...">
        </div>
		
		
	<?php
	
	$games = array();
	
function addInfo($list, $que)
{
	if ($que->num_rows > 0) {
     // output data of each row
     while($row = $que->fetch_assoc()) 
	 {
		 array_push($list, new Game($row["status"],								//Status of game
									$row["verified"],							//Status of game
									$row["logo"], 								//logo URL
									$row["badges"], $row["badgeMAX"], 			//Badges/total
									$row["name"], 								//name
									$row["version"], 							//Current version, '0' if none
									$row["description"],						//50 character description
									$row["medium"],								//RPGMAKER, ROM, or other
									$row["fakemon"],  							//How much fakemon
									$row["twitter"], 							//twitter link, 'none' if none
									$row["reddit"], 							//reddit
									$row["facebook"], 							//facebook
									$row["website"], 							//website
									$row["tumblr"], 							//tumblr
									$row["relicCastle"], 						//Relic Castle
									$row["pokeCommunity"], 						//PokeCommunity
									$row["pokeBeach"], 							//PokeBeach
									$row["pokemonReborn"], 						//Pokemon Reborn
									$row["commuSP"],							//Community Script project
									$row["deviantArt"], 						//Deviantart
									$row["soundCloud"],							//soundcloud
									$row["discord"]));							//discord
     }
} else {
     //echo "0 results";
}
}

//////////////////////////////////////////////////////////////////////////////////////////////////RESOURCES
//a line of badges that is configured as NUM COMPLETE, NUM TOTAL
class BadgeLine
{
				public $num;
				public $complete;
				
				public function __construct($num, $complete)
				{
					$this->num = $num;
					$this->complete = $complete;
				}
				
				//prints each badge, either complete or incomplete, and then whitespace.
				//Avoids whitespace at end
				public function display()
				{
					if ($this->complete != 0)
					{
						echo "<div class=\"badges\">
								<div class=\"badges-title\">Badge Completion</div>";
						for ($i = 0; $i < $this->complete; $i = $i + 1)
						{
							if ($i < $this->num)
							{
								echo "<img src=\"images/small_ball.png\">";
							}
							else
								echo '<img src="images/small_ball.png" class="faded">';
							if ($i < ($this->complete) - 1 && ($i + 1) % 8 == 0 )
								echo "</br>";
						}
						echo '</div>';
					}
				}
			}
			
class Game{
				public $status;
				public $verified;
				public $logo;
				public $badges;
				public $badgeMAX = 8;
				public $name;
				public $version;
				public $description;
				public $medium;
				public $fakemon;
				public $social = array('twitter'=>'link',
										'reddit'=>'link', 
										'facebook'=>'link',
										'website'=>'link',
										'tumblr'=>'link',
										'rc'=>'link',
										'pc'=>'link',
										'pb'=>'link',
										'pr'=>'link',
										'commuSP'=>'link',
										'deviantart'=>'link',
										'soundcloud'=>'link',
										'discord'=>'link');
										
				public function __construct($status, $verified, $logo, $badges, $badgeMAX, $name, $version, $description, $medium, $fakemon,
											$twitter, $reddit, $facebook, $website, $tumblr, $rc, $pc, $pb, $pr, $commuSP, $deviantart, $soundcloud, $discord)
				{
					$this->status = $status;
					$this->verified = $verified;
					$this->logo	= $logo;
					$this->badges = $badges;
					$this->badgeMAX = $badgeMAX;
					$this->name = $name;
					$this->version = $version;
					$this->description = $description;
					$this->medium = $medium;
					$this->fakemon = $fakemon;
					$this->social['twitter'] = $twitter;
					$this->social['reddit'] = $reddit;
					$this->social['facebook'] = $facebook;
					$this->social['website'] = $website;
					$this->social['tumblr'] = $tumblr;
					$this->social['rc'] = $rc;
					$this->social['pc'] = $pc;
					$this->social['pb'] = $pb;
					$this->social['pr'] = $pr;
					$this->social['commuSP'] = $commuSP;
					$this->social['deviantart'] = $deviantart;
					$this->social['soundcloud'] = $soundcloud;
					$this->social['discord'] = $discord;
				}
				
				public function display()
				{
					//create an article
					echo '<article>';
					
					//display status
					if ($this->status != 'ACTIVE')
					{
						if ($this->status == 'ON_BREAK')
							echo '<div class="banner banner-break">
									On Break
								</div>';
						elseif ($this->status == 'ABANDONED')
							echo '<div class="banner banner-abandoned">
									Abandoned
								</div>';
						elseif ($this->status == 'COMPLETED')
							echo '<div class="banner banner-completed">
									Completed
								</div>';
					}
					
					//display Fakemon and Medium
					$part1 = '<div class="has-fakemon ';
					if ($this->fakemon == 'ALL')
						$part1 = $part1 . 'fakemon-all"><img style="height: 12px;" src="images/fakemon.gif" ;="">
                            ALL';
					elseif ($this->fakemon == 'MIXED')
						$part1 = $part1 . 'fakemon-mixed"><img style="height: 12px;" src="images/fakemon.gif" ;="">
                            MIXED';
					elseif ($this->fakemon == 'LIMITED')
						$part1 = $part1 . 'fakemon-limited"><img style="height: 12px;" src="images/fakemon.gif" ;="">
                            LIMITED';
					elseif ($this->fakemon == 'NONE')
						$part1 = $part1 . 'fakemon-none"><img style="height: 12px;" src="images/fakemon.gif" ;="">
                            NONE';
					else
						$part1 = $part1 . 'fakemon-unknown"><img style="height: 12px;" src="images/fakemon.gif" ;="">
                            UNKNOWN';
							
					$part1 = $part1 . '</div>';
					
					$part2 = '<div class="medium">
                            <img style="width: 12px;" src="images/medium.png" ;="">' . $this->medium . '</div>';
					
					echo $part1 . $part2;
					
					//create image
					echo '<a><img  style="width: 180px;"  src="images/' . $this->logo . '" alt="' . $this->name . '"></a>';
					
					//display badges
					echo '<h1  style="text-align: center;">';
					$badgebar = new BadgeLine($this->badges, $this->badgeMAX);
					$badgebar->display();
					echo '</h1>';
					
					//display title
					echo '<h2  style="text-align: center;">' . $this->name . '</h2>';
					
					//display version
					if ($this->version != '0')
						echo '<h6>' . $this->version . '</h6>';
					
					//display description
					echo '<p>' . $this->description . '</p>'; 
					
					//display horizontal rule
					echo '<hr>';
					
					//display all social media links
					foreach ($this->social as $site=>$link)
					{
						if (!is_null($link))
							echo '<a  target="_blank"  href="' . $link . '"class="media"><img  style="height: 20px;"  src="images/' . $site . '.png"></a>';
					}
					
					//end article
					echo '</article>';

				}
				
			}
			
$servername = "hidden";
$username = "hidden";
$password = "hidden";
$dbname = "hidden";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}

//add normal ones A - Z

$active = "SELECT * 
FROM  `Games2` 
WHERE STATUS <>  'ABANDONED'
ORDER BY  `name` ASC ;";
$result = $conn->query($active);
addInfo(&$games, $result);

//add abandoned ones A - Z

$active = 
"SELECT * 
FROM  `Games2` 
WHERE STATUS = 'ABANDONED'
ORDER BY  `name` ASC ";
$result = $conn->query($active);
addInfo(&$games, $result);



$conn->close();
?>  
    <div  id="secwrapper">
      <div  style="text-align: center;">
        <section  class="section">
		<?php 
		foreach ($games as $game)
		{			
			if($game->verified == 1)
				$game->display();
		}
		?>
          
        </section>
      </div>
    </div>
        <div style="text-align: center;">
            <span style="font-weight: bold;">
                <span class="main-font" style="">
                    <a>
                        *Some
                        logos replaced/added for sake of conformity.
                        <br>
                        Check out PokeCommunity, Relic Castle, Pokemon Reborn, et al. for
                        many other games.
                        <br>
                        Issues? Bad description? Broken link? You want your game
                        on this list? Please Contact us to fix this list! PLEASE!!!!
                        <br>
                    </a>
                </span>
            </span>
        </div>
        <footer style="background-color: rgb(66, 66, 66);">
            <p style="text-align: center;">
             Pokemon and its trademarks are property
             of GAME FREAK, the Pokemon Company International, and Nintendo.
             PokeFanWorks does not claim nor intend any ownership over Pokemon or any
             games shown. Please support the official release, and buy the real
             games.
         </p>
         <p style="text-align: center;">
            <br>
            Website Template copyright © 2012 BoxPress by Youssef Nassim. All Rights Reserved.<br>
			Styles, Searchbar, and a lot more made by  <a href="http://www.pokemon-factory.com/ " target="_blank">bonzairob</a>.  Go check it out!
        </p>
    </footer>
	
	<script>
        $(document).ready(function(){//when the page has loaded...

            $('input[name="filter"]').keyup(function(){
                var searching_for = $(this).val(); //the text insde the textbox
                if (searching_for == ""){
                    //if we blanked it, show all articles
                    $('article').show();

                } else {
                    //otherwise...

                    $('article').each(function(){ //for each <article> tag...

                        //we'll be making a long piece of text to look in
                        //if we haven't made one already!

                        var searchable_text = "";

                        if ( $('.search-text', $(this)).length ){ //if there's a <div class="searchable_text"> in this article
                             searchable_text = $('.search-text', $(this)).text(); //then we use that

                        } else {
                            //otherwise, we need to make one for next time.
                            searchable_text = $('h2', $(this)).text();  //grab the name... ( that is, the <h2> inside this article - $() works like css mostly! )
                            searchable_text += ' ' + $('p', $(this)).text(); // the description...
                            searchable_text += ' ' + $('.has-fakemon', $(this)).text(); // fakemon... (text() ignores images!)
                            searchable_text += ' ' + $('.medium', $(this)).text(); // medium...
                            searchable_text += ' ' + $('.banner', $(this)).text(); // status banner..

                            //save it in a hidden div for next time!
                            var $hidden_div = $('<div class="search-text">');//creates a blank div
                            $hidden_div.text(searchable_text);//sets the text inside the div
                            $(this).append($hidden_div); //appends it to the article
                            $hidden_div.hide(); //hide it, never to be shown!
                        }

                        //so at this point we should have like
                        // "Uranium Fight Nuclear Pokémon in meltdown panic ALL RMXP"
                        // so if they aserched for Uranium, or RMXP it's here
                        // although we're gonna convert it all to lower case because code is pedantic.
                        console.log( [searchable_text, searching_for, searchable_text.toLowerCase().match(searching_for.toLowerCase())] )
                        if (searchable_text.toLowerCase().match(searching_for.toLowerCase())){
                            $(this).show(); //we'll call show in case it was hidden earier.
                        } else {
                            //if the searched_text wasn't here, hide it!
                            $(this).hide();
                        }
                    })
                }
            })


        })
    </script>
  </body>
</html>
