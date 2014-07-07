<?php

# Creates the models for the application
use Illuminate\Database\Capsule\Manager as Capsule;

# Users
Capsule::schema()->create('users', function($table)
{
	$table->increments('id');
	$table->text('display_name');
	# Main language of user
	$table->integer('lang_id')->references('id')->on('languages');
	# Topics (json containing the array of referenced id)
	$table->text('topics_array'); 
	$table->string('slug'); 	
	# Email will be used as a username
	$table->string('email')->unique();
	# Memberships (json containing the array of referenced id)
	$table->text('membership_types_array'); 
	$table->string('adsense_id');
	
	$table->timestamps();
});

# Articles
Capsule::schema()->create('articles', function($table)
{
	$table->increments('id');
	$table->binary('content');
	# Main language of article
	$table->integer('lang_id')->references('id')->on('languages');
	# Media (json containing the array of referenced id)
	$table->text('media_array');
	# Links (json containing the array of referenced id)
	$table->text('links_array');
	# Tags (json containing the array of referenced id)
	$table->text('tags_array'); 
	# Topic
	$table->integer('topic_id')->references('id')->on('topics');
	# Statut of article
	$table->integer('status_id')->references('id')->on('status');
	
	$table->timestamps();
	$table->softDeletes();
	
});

# Membertypes
# ex : "author", "translator", "editor", "admin"
Capsule::schema()->create('membertypes', function($table)
{
	$table->increments('id');
	$table->text('name');
	
});

# Languages
Capsule::schema()->create('languages', function($table)
{
	$table->increments('id');
	# Name in json (to have the translated version too)
	$table->text('name_json');
	$table->string('slug'); 
	
});

# Topics
Capsule::schema()->create('topics', function($table)
{
	$table->increments('id');
	# Name in json (to have the translated version too)
	$table->text('name_json');
	# Slug in json (to have the translated version too)
	$table->string('slug_json'); 
	
});

# Tags
Capsule::schema()->create('tags', function($table)
{
	$table->increments('id');
	# Name in json (to have the translated version too)
	$table->text('name_json');
	# Slug in json (to have the translated version too)
	$table->string('slug_json'); 
	
});

# Status
Capsule::schema()->create('status', function($table)
{
	$table->increments('id');
	# Name in json (to have the translated version too)
	$table->text('name_json');
	
});

# Missing Translations
# When a new article is sumbmitted, a list of missing translations is automaticcally
# created for every existing languages
Capsule::schema()->create('missing-translations', function($table)
{
	$table->increments('id');
	# Type : article, tag, topic
	$table->text('type');
	# Slug in json (to have the translated version too)
	$table->integer('lang_id')->references('id')->on('languages');
	# The id of the referenced item of type 'type'
	$table->integer('id_item');
	
	$table->timestamp('created_at');
	$table->softDeletes();
	
});