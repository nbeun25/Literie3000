select matelas.nom as "Nom matelas", dimensions.dimension as "Dimensions", marques.nom as "Marque" from marques
right join matelas
on marques.id = matelas.marques_id 
right join dimensions
on matelas.dimensions_id = dimensions.id 
group by matelas.nom

alter table matelas
add picture varchar(300)
