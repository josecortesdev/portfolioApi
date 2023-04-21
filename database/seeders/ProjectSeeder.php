<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->save('MYKELT.COM (Noviembre, 2021)', 'Mykelt es una aplicación web que hice para un cliente que necesita un ecommerce y blog personalizados. Soporta autenticación OAuth y es posible registrarse con la cuenta de Google. También incluye pagos con Stripe.

        Tecnologías principales.
        El frontend está hecho en Angular y el backend es una API REST hecha con Laravel. Utilizo los paquetes de Laravel Cashier (Stripe) y Socialite.
        
        Ecommerce.
        Para la implementación de los pagos usé el paquete de Laravel Cashier y Stripe. Incluye carrito de la compra con casillas de verificación, selección de unidades y cálculo de precio total.
        
        Blog.
        Utilizo la librería CKEditor para permitir la edición de artículos que posteriormente se almacenan en la base de datos. En el editor es posible cambiar la tipografía, el tamaño, añadir tablas e imágenes. Solo las cuentas con rol de administrador pueden crear, editar y borrar artículos.
        
        Autenticación.
        Diferenciamos entre dos roles: usuario y administrador. Uso el paquete de Laravel Socialite para incluir autenticación OAuth con Google. Incluyo Json Web Token (JWT) para la creación de tokens de acceso.
        
        Seguridad.
        En Angular protejo las vistas con guards y en Laravel filtro las peticiones HTTP con middlewares. Las contraseñas están encriptadas con Laravel Hash que proporciona una encriptación con Bcrypt, que está basado en el cifrado de Blowfish. Las contraseñas están encriptadas con PASSWORD_DEFAULT, que utiliza el algoritmo bcrypt y se actualiza siempre que se añada un algoritmo nuevo más fuerte.', 'https://mykelt.com/', 'https://github.com/josecortesdev/BackMykelt', 'https://josecortesdev.github.io/portafolio/#videomykelt', 'https://josecortesdev.github.io/portafolio/#explicacionesmykelt', null, true, [1,3]);

    }
    public function save($name, $description, $url, $code, $showVideo, $explanationVideo, $video, $active, $technologies)
    {
        $project = new Project();
        $project->name = $name;
        $project->description = $description;
        $project->url = $url;
        $project->code = $code;
        $project->showVideo = $showVideo;
        $project->explanationVideo = $explanationVideo;
        $project->video = $video;
        $project->active = $active;


        $project->save();
        $project->technologies()->sync($technologies);
    }
}
