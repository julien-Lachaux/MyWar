conscrit = document.querySelector('#conscrit');
soldat = document.querySelector('#soldat');
archer = document.querySelector('#archer');
chevalier = document.querySelector('#chevalier');
data = document.querySelector('#data');

AjaxRequest(conscrit, data, 'chargement ...');
AjaxRequest(soldat, data, 'chargement ...');
AjaxRequest(archer, data, 'chargement ...');
AjaxRequest(chevalier, data, 'chargement ...');