

CREATE TABLE IF NOT EXISTS `aa_allopass` (
  `id` int(11) NOT NULL,
  `idd` int(11) NOT NULL,
  `auth` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `aa_config` (
  `id` mediumint(9) NOT NULL auto_increment,
  `hebergeur` varchar(155) NOT NULL,
  `mail_admin` varchar(155) NOT NULL default '',
  `titre_site` varchar(155) NOT NULL default '',
  `version` varchar(155) NOT NULL default '',
  `mess_maintenance` varchar(155) NOT NULL default '',
  `mess_acceuil` text NOT NULL,
  `url_site` varchar(255) NOT NULL default '',
  `nom_team` varchar(155) NOT NULL,
  `maint` decimal(10,0) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `aa_demande` (
  `id` mediumint(9) NOT NULL auto_increment,
  `pseudo` varchar(255) NOT NULL default '',
  `email` text NOT NULL,
  `steamid` varchar(255) NOT NULL default '',
  `serveur` varchar(255) NOT NULL default '',
  `pay_valid` varchar(2) NOT NULL default '',
  `validation` char(3) NOT NULL default '',
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=371 ;

CREATE TABLE IF NOT EXISTS `aa_donnee_serveur` (
  `id` mediumint(9) NOT NULL auto_increment,
  `ip_serveur` varchar(21) NOT NULL default '',
  `port_serveur` text NOT NULL,
  `nom_serveur` varchar(155) NOT NULL default '',
  `plugin_serveur` varchar(155) NOT NULL default '',
  `chemin` varchar(155) NOT NULL default '',
  `rcon` text NOT NULL,
  `id_ftp` text NOT NULL,
  `mdp_ftp` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;


CREATE TABLE IF NOT EXISTS `aa_flags` (
  `immunity` text NOT NULL,
  `admin` text NOT NULL,
  `groupe` text NOT NULL,
  `plugin` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `aa_hebergeur` (
  `id` mediumint(9) NOT NULL auto_increment,
  `hebergeur` varchar(155) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;


CREATE TABLE IF NOT EXISTS `aa_lien` (
  `id` mediumint(9) NOT NULL auto_increment,
  `nom` varchar(30) NOT NULL,
  `lien` text NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `aa_lien_cat` (
  `id` int(11) NOT NULL auto_increment,
  `cat_lien` text NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `aa_mail` (
  `type_mail` text NOT NULL,
  `titre` text NOT NULL,
  `corps` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `aa_membre` (
  `id_membre` mediumint(11) NOT NULL auto_increment,
  `pseudo` varchar(20) NOT NULL,
  `passe` varchar(60) NOT NULL,
  `id` text NOT NULL,
  `level` int(9) NOT NULL,
  `email` text NOT NULL,
  `steamid` text NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `token` bigint(20) NOT NULL,
  `etat` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id_membre`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;


CREATE TABLE IF NOT EXISTS `aa_modul_pay` (
  `id` mediumint(9) NOT NULL auto_increment,
  `nb` int(11) NOT NULL,
  `type_tps` varchar(7) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

CREATE TABLE IF NOT EXISTS `aa_paiement` (
  `id` mediumint(9) NOT NULL auto_increment,
  `nom` text NOT NULL,
  `type` varchar(155) NOT NULL default '',
  `script_insert` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

CREATE TABLE IF NOT EXISTS `aa_type_pay` (
  `temps` int(11) NOT NULL,
  PRIMARY KEY  (`temps`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
