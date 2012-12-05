dotaba
======
Kohana v3.3.0

Prije početka (ponovo) pročitati Kohana *user guide* (izmijenjene su neke bitne 
stvari, kao što upute za imena datoteka i sl.).

Resursi:  
[Kohana guide][]  
[Try GitHub][]  
[Stack Overflow][]

Poželjno je instalirati [GitHub for Windows][] koji automatski dodaje SSH *key* 
i pravilno konfigurira Git za Windowse (*newline* i sl.), ali koristiti 
*command-line* za git operacije.

Pridržavati se sljedećeg:  
[Kohana conventions][]  
[Git branching model][]  
[Commit messages][]

Za početak *forkati repository* (*develop branch*), zatim izvršiti  
`git clone --recursive git@github.com:USERNAME/dotaba.git` (*recursive* kako bi 
se skinuli i git *submoduli*).  
Prije toga, naravno, doći do željenog direktorija, npr. `C:/xampp/htdocs`, u 
kojem bi se napravio direktorij *dotaba*.  
Zatim napraviti izmjene, spasiti *commitove*, dodati *remote*, preko  
`git remote add origin NAZIV_REPOZITORIJA`, *pushati* pomoću `git push origin 
naziv_brancha` (branch će uglavnom biti develop, osim ako radimo na nekom većem 
*featureu*). Nakon toga napraviti *pull request*.
Važno: trenutno nemamo organizaciju, tako da ne možemo podešavati dopuštenja 
GitHub repozitorija, pa nakon *pull requesta* ne treba *mergeati*. To ću 
uraditi nakon što pogledam izmjene, kako ne bi došlo do prepisivanja datoteka.

Pošto sav development vršimo lokalno, dobro je dodati *virtual host* kako bi se 
sajtu moglo pristupiti preko http://dotaba/.  
Upute: otvoriti `C:/Windows/System32/drivers/etc` i dodati  
`127.0.0.1 dotaba`  
Zatim otvoriti `C:/xampp/apache/conf/extra/httpd-vhosts.conf` i dodati:  

	<VirtualHost *:80>
	    DocumentRoot "C:/xampp/htdocs"
	    ServerName localhost
	    <Directory "C:/xampp/htdocs">
	        AllowOverride All
	        Order Allow,Deny
	        Allow from all
	        Require all granted
	    </Directory>
	</VirtualHost>
	<VirtualHost *:80>
	    DocumentRoot "C:/xampp/htdocs/dotaba"
	    ServerName dotaba
	    <Directory "C:/xampp/htdocs/dotaba">
	        AllowOverride All
	        Order Allow,Deny
	        Allow from all
	        Require all granted
	    </Directory>
	</VirtualHost>

Nakon toga *restartovati server*.

Za promjene ove datoteke (README.md) koristiti [Markdown][] sintaksu.

[Kohana guide]:        http://www.kohanaframework.org/3.3/guide
[Try GitHub]:          http://try.github.com
[Stack Overflow]:      http://www.stackoverflow.com
[GitHub for Windows]:  http://windows.github.com
[Kohana conventions]:  http://www.kohanaframework.org/3.3/guide/kohana/conventions
[Git branching model]: http://www.nvie.com/posts/a-successful-git-branching-model
[Commit messages]:     http://www.tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html
[Markdown]:            http://www.daringfireball.net/projects/markdown