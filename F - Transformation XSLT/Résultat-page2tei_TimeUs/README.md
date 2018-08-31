Ce dossier contient l'environnement utilisé pour appliquer la feuille de transformation XSLT de manière récursive, en utilisant le parseur java **Saxon 9 HE**.

Les fichiers orignaux se trouvent dans le dossier `input` : ce sont les fichiers PAGE contenant les transcriptions des pages au statut "DONE" des documents de la collection Time Us, après transformation pour rassembler toutes les pages d'un document en un seul fichier xml. 

Les fichiers transformés se trouvent dans le dossier `output`.

La commande exécutée pour réaliser la transformation est la suivante : 

`java -jar saxon9he.jar -s:input/ -o:output/ -xsl:page2tei_TU.xsl`


