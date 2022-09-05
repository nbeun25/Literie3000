alter table matelas
add picture varchar(300)

SELECT matelas.nom as 'nom', matelas.prix as 'prix', matelas.prix_remise as 'reduction', dimensions.dimension as 'Dimensions', marques.nom as 'marque' from marques RIGHT JOIN matelas
on marques.id = matelas.marques_id 
right join dimensions
on matelas.dimensions_id = dimensions.id 
group by matelas.nom

https://kipli.com/fr/wp-content/uploads/2021/07/69_113_20-min.jpg