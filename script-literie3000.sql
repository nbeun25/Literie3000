alter table matelas
add picture varchar(300)

SELECT matelas.nom as 'nom', matelas.prix as 'prix', matelas.prix_remise as 'reduction', dimensions.dimension as 'Dimensions', marques.nom as 'marque' from marques RIGHT JOIN matelas
on marques.id = matelas.marques_id 
right join dimensions
on matelas.dimensions_id = dimensions.id 
group by matelas.nom

3	1	Matelas Isamel	1	759.00	529.00	https://www.lematelas.fr/media/wysiwyg/choisir-matelas.jpg
4	2	Matelas Jose	1	809.00	709.00	https://www.leroidumatelas.fr/media/catalog/product/cache/1/thumbnail/9df78eab33525d08d6e5fb8d27136e95/M/A/MAT-EPICEA_01_4.jpg