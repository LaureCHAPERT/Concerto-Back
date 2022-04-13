# Dictionnaire de données

## Evénements (`event`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de l'évenement|
|name|VARCHAR(50)|NOT NULL|Le nom de l'événement|
|description|TEXT|NOT NULL|La description de l'évenement|
|date|date|NOT NULL|La date de l'évenement|
|hour|time|NULL|L'heure de l'évenement|
|price|DECIMAL(10,2)|NOT NULL, DEFAULT 0|Le prix de l'évenement|
|image|VARCHAR(255)|NULL|L'URL de l'image de l'évenement|
|link_ticketing|VARCHAR(255)|NOT NULL|Le lien de la billetterie de l'évenement|
|slug|VARCHAR(50)|NULL|Le slug (nom) de l'évenement|
|region|entity|NOT NULL|La région (autre entité) de l'évenement|
|genre|entity|NOT NULL|Le genre (autre entité) de l'évenement|
|user|entity|NOT NULL|L'utilisateur (autre entité) qui a crée l'évenement|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création l'évenement|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour l'évenement|

## Genres (`genre`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du genre|
|name|VARCHAR(50)|NOT NULL|Le nom du genre|
|image|VARCHAR(255)|NOT NULL|Le nom de l'image d genre|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du genre|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour du genre|

## Régions (`region`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de la région|
|name|VARCHAR(50)|NOT NULL|Le nom de la région|
|image|VARCHAR(255)|NOT NULL|Le nom de l'image de la région|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de la région|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour de la région|

## Utilisateurs (`user`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de la catégorie|
|username|VARCHAR(50)|NOT NULL|Le nom d'utilisateur|
|image|VARCHAR(255)|NULL|Le nom de l'image (avatar) de l'utilisateur|
|email|VARCHAR(255)|NOT NULL|L'email de l'utilisateur|
|password|VARCHAR(255)|NOT NULL|Le mot de passe de l'utilisateur|
|role|VARCHAR(50)|NOT NULL|Le(s) rôle(s) de l'utilisateur|
|active|TINYINT(1)|NOT NULL, DEFAULT 0|Statut de l'utilisateur|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de l'utilisateur|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour de l'utilisateur|