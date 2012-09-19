<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: check_agent.inc.php 2 2011-06-06 12:08:34Z siekiera $
* 	Letzter Stand:			$Revision: 2 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-06 14:08:34 +0200 (Mon, 06 Jun 2011) $
*
* 	SEO:mercari by Siekiera Media
* 	http://www.seo-mercari.de
*
* 	Copyright (c) since 2011 SEO:mercari
* --------------------------------------------------------------------------------------
* 	based on:
* 	(c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
* 	(c) 2002-2003 osCommerce - www.oscommerce.com
* 	(c) 2003     nextcommerce - www.nextcommerce.org
* 	(c) 2005     xt:Commerce - www.xt-commerce.com
*
* 	Released under the GNU General Public License
* ----------------------------------------------------------------------------------- */



function check_agent()
{
if (CHECK_CLIENT_AGENT=='true') {
   $Robots = array (
   "antibot",
   "appie",
   "architext",
   "bjaaland",
   "digout4u",
   "echo",
   "fast-webcrawler",
   "ferret",
   "googlebot",
   "gulliver",
   "harvest",
   "htdig",
   "ia_archiver",
   "jeeves",
   "jennybot",
   "linkwalker",
   "lycos",
   "mercator",
   "moget",
   "muscatferret",
   "myweb",
   "netcraft",
   "nomad",
   "petersnews",
   "scooter",
   "slurp",
   "unlost_web_crawler",
   "voila",
   "voyager",
   "webbase",
   "weblayers",
   "wget",
   "wisenutbot",
   "acme.spider",
   "ahoythehomepagefinder",
   "alkaline",
   "arachnophilia",
   "aretha",
   "ariadne",
   "arks",
   "aspider",
   "atn.txt",
   "atomz",
   "auresys",
   "backrub",
   "bigbrother",
   "blackwidow",
   "blindekuh",
   "bloodhound",
   "brightnet",
   "bspider",
   "cactvschemistryspider",
   "cassandra",
   "cgireader",
   "checkbot",
   "churl",
   "cmc",
   "collective",
   "combine",
   "conceptbot",
   "coolbot",
   "core",
   "cosmos",
   "cruiser",
   "cusco",
   "cyberspyder",
   "deweb",
   "dienstspider",
   "digger",
   "diibot",
   "directhit",
   "dnabot",
   "download_express",
   "dragonbot",
   "dwcp",
   "e-collector",
   "ebiness",
   "eit",
   "elfinbot",
   "emacs",
   "emcspider",
   "esther",
   "evliyacelebi",
   "nzexplorer",
   "fdse",
   "felix",
   "fetchrover",
   "fido",
   "finnish",
   "fireball",
   "fouineur",
   "francoroute",
   "freecrawl",
   "funnelweb",
   "gama",
   "gazz",
   "gcreep",
   "getbot",
   "geturl",
   "golem",
   "grapnel",
   "griffon",
   "gromit",
   "hambot",
   "havindex",
   "hometown",
   "htmlgobble",
   "hyperdecontextualizer",
   "iajabot",
   "ibm",
   "iconoclast",
   "ilse",
   "imagelock",
   "incywincy",
   "informant",
   "infoseek",
   "infoseeksidewinder",
   "infospider",
   "inspectorwww",
   "intelliagent",
   "irobot",
   "iron33",
   "israelisearch",
   "javabee",
   "jbot",
   "jcrawler",
   "jobo",
   "jobot",
   "joebot",
   "jubii",
   "jumpstation",
   "katipo",
   "kdd",
   "kilroy",
   "ko_yappo_robot",
   "labelgrabber.txt",
   "larbin",
   "legs",
   "linkidator",
   "linkscan",
   "lockon",
   "logo_gif",
   "macworm",
   "magpie",
   "marvin",
   "mattie",
   "mediafox",
   "merzscope",
   "meshexplorer",
   "mindcrawler",
   "momspider",
   "monster",
   "motor",
   "mwdsearch",
   "netcarta",
   "netmechanic",
   "netscoop",
   "newscan-online",
   "nhse",
   "northstar",
   "occam",
   "octopus",
   "openfind",
   "orb_search",
   "packrat",
   "pageboy",
   "parasite",
   "patric",
   "pegasus",
   "perignator",
   "perlcrawler",
   "phantom",
   "piltdownman",
   "pimptrain",
   "pioneer",
   "pitkow",
   "pjspider",
   "pka",
   "plumtreewebaccessor",
   "poppi",
   "portalb",
   "puu",
   "python",
   "raven",
   "rbse",
   "resumerobot",
   "rhcs",
   "roadrunner",
   "robbie",
   "robi",
   "robofox",
   "robozilla",
   "roverbot",
   "rules",
   "safetynetrobot",
   "search_au",
   "searchprocess",
   "senrigan",
   "sgscout",
   "shaggy",
   "shaihulud",
   "sift",
   "simbot",
   "site-valet",
   "sitegrabber",
   "sitetech",
   "slcrawler",
   "smartspider",
   "snooper",
   "solbot",
   "spanner",
   "speedy",
   "spider_monkey",
   "spiderbot",
   "spiderline",
   "spiderman",
   "spiderview",
   "spry",
   "ssearcher",
   "suke",
   "suntek",
   "sven",
   "tach_bw",
   "tarantula",
   "tarspider",
   "techbot",
   "templeton",
   "teoma_agent1",
   "titin",
   "titan",
   "tkwww",
   "tlspider",
   "ucsd",
   "udmsearch",
   "urlck",
   "valkyrie",
   "victoria",
   "visionsearch",
   "vwbot",
   "w3index",
   "w3m2",
   "wallpaper",
   "wanderer",
   "wapspider",
   "webbandit",
   "webcatcher",
   "webcopy",
   "webfetcher",
   "webfoot",
   "weblinker",
   "webmirror",
   "webmoose",
   "webquest",
   "webreader",
   "webreaper",
   "websnarf",
   "webspider",
   "webvac",
   "webwalk",
   "webwalker",
   "webwatch",
   "whatuseek",
   "whowhere",
   "wired-digital",
   "wmir",
   "wolp",
   "wombat",
   "worm",
   "wwwc",
   "wz101",
   "xget",
   "awbot",
   "bobby",
   "boris",
   "bumblebee",
   "cscrawler",
   "daviesbot",
   "ezresult",
   "gigabot",
   "gnodspider",
   "internetseer",
   "justview",
   "linkbot",
   "linkchecker",
   "nederland.zoek",
   "perman",
   "pompos",
   "pooodle",
   "redalert",
   "shoutcast",
   "slysearch",
   "ultraseek",
   "webcompass",
   "yandex",
   "robot",
   "yahoo",
   "bot",
   "psbot",
   "crawl"
   );


   $botID = strtolower($_SERVER['HTTP_USER_AGENT']);
   $botID2 = strtolower(getenv("HTTP_USER_AGENT"));
   for ($i = 0; $i < count($Robots); $i++)
   {

      if (strstr($botID, $Robots[$i]) or strstr($botID2, $Robots[$i]))
      {
         return 1;
      }

   }
   return 0;
} else {
return 0;
}

}

?>
