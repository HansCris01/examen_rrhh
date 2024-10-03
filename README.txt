
Ejecutar en esa orden: 


1) php artisan migrate --path=/database/migrations/2024_10_03_020438_create_titulars_table.php

2) php artisan migrate --path=/database/migrations/2024_10_03_020403_create_tipo_cuentas_table.php

3) php artisan migrate --path=/database/migrations/2024_10_03_020541_create_tipos_table.php

4) php artisan migrate --path=/database/migrations/2024_10_03_020839_create_cuentas_table.php

5) php artisan migrate --path=/database/migrations/2024_10_03_020628_create_historial_transacciones_table.php


Consumir microservicios

1) Ver cuentas  metodo : GET

http://localhost:81/examen_rrhh/servicio_web/public/api/cuentas


2) Detalle de la cuenta buscando por el id de la cuenta, metodo : GET

http://localhost:81/examen_rrhh/servicio_web/public/api/detalle_cuenta/2

3) Para retiro: metodo : PUT
Nota: Tienes que usar una herramienta como POSTMAN para poder consumir los servicios

El id = 1 que esta en la URL es el id de la cuenta a la que va hacer retiro

link: http://localhost:81/examen_rrhh/servicio_web/public/api/retiro/1

En el postman tienes que ir a BODY, seleccionar RAW donde le va aparecer una opcion para desglozar
seleccione JSON y escriba este codigo:

{
   "monto": 90
}

Le da SEND y ya esta funcionando.


4) Para transferencia metodo : PUT

El id = 1 que esta en la URL es el id de la cuenta va enviar la transferencia

link: http://localhost:81/examen_rrhh/servicio_web/public/api/transferencia/1

En el postman tienes que ir a BODY, seleccionar RAW donde le va aparecer una opcion para desglozar
seleccione JSON y escriba este codigo:

{
   "monto": 12.40,
   "id_recibe":2
}

Le da SEND y ya esta funcionando.


5) Para deposito, metodo : POST

  link: http://localhost:81/examen_rrhh/servicio_web/public/api/depositar

En el postman tienes que ir a Body
vas a tener estas opciones:

none, form-data, x-www-form-urlencoded, raw, binary, GraphQl

VAMOS SELECCIONAR: raw    va aparecer el selector al lado de GraphQl seleccionas JSON

colocas este código:

{
   "id": 1,
   "monto": 1000
}
