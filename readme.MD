# README

## 🚀 Instalación del proyecto

Se incluye fichero INSTALL.md con las instrucciones genericas de instalación.

## 💻 Consideraciones del proyecto

### Arquitectura 

Se realiza proyecto en symfony 5.4 sobre PHP 8.1 utilizando Arquitectura Hexagonal, 
a mayores se aplicado CQRS para lograr un mayor desacople de los diferentes artificios.

No he utilizado DDD sobre hexagonal porque no hay eventos relevantes, si lo véis necesario 
implemento un ejemplo.

Como ejemplo, se implementa un CommandBus que tiene registrado un handler CacheAllWebcamCommandHandler
utilizado como caso de uso para crear una cache de Webcams.

Además, se implementa un QueryBus, que tiene registrado un handler SearchMemberByUrlAndAllWebcamsQueryHandler
que implementa el caso de uso de obtener el afiliado y sus webcams.

He creado una sencilla estructura en src, con las carpetas Infraestructure, Application y Domain. Desconozco
cual es la utilizada por vosotros pero para ver claramente las diferentes capas de la arquitectura es suficiente.

En lo referente a algunas interfaces de algunos servicios de infraestructura suelo utilizar los contratos
definidos por la comunidad como PSR o Symfony/Contracts, ya que las muchas de las implementaciones existentes
se ajustasn a estos interfaces.

### Cache

Para optimizar el tiempo de carga de las landings de cada afiliado se utilizan dos enfoques:

1) Existe un command que se ejecutará en el CRON cada minuto y sincronizará los datos en background de las webcams.

2) Se utiliza las cabeceras de la respuesta para cachear la web durante 1 minuto, para no tener que renderizar en cada petición la página.

En definitiva, a un usuario cada minuto se le renderizará la web con la cache de webcams viene tardando 15ms + latencia. El resto de usuarios descargaran de cache, 
y tardará la latencia propia de la red.

### Testing

He realizado un conjunto parcial de pruebas (no pretende ser completo) pero si abarcar ejemplos de Unit Test, Integration Test y Acceptance Test.

Para la inyección de dependencias en los Unit Test he utilizado 4 técnicas diferentes, a modo de ejemplo:

1) El selector de implementaciones de symfony, configurado en config_test.yaml

2) Inyección de mock con librería de Symfony

3) Inyección de clase anónima

4) Patrón Shun, implementando los metodos de la interfaz en la misma clase de testing.

## Comentarios

No he incluído comentarios en el código, en principio seguimos la filosofía que el código debe ser autocomentado,
de todas formas cada empresa tiene sus normas, si lo veis necesario se pueden incluir.