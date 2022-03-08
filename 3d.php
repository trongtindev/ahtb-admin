<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .face {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <div id="container"></div>

    <!-- <canvas id="face0" width="2048" height="2048" class="face"></canvas>
    <canvas id="face1" width="2048" height="2048" class="face"></canvas>
    <canvas id="face2" width="2048" height="2048" class="face"></canvas>
    <canvas id="face3" width="2048" height="2048" class="face"></canvas>
    <canvas id="face4" width="2048" height="2048" class="face"></canvas>
    <canvas id="face5" width="2048" height="2048" class="face"></canvas> -->

    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.min.js"></script>
    <script>
        // var resorts = {
        //     '1_1_1': '1_2_0',
        //     '1_2_0': '1_1_1',
        //     '2_1_2': '2_2_1',
        //     '2_2_1': '2_1_2',
        //     '2_2_3': '2_3_2',
        //     '2_3_2': '2_2_3',
        //     '2_0_1': '2_1_0',
        //     '2_1_0': '2_0_1',
        // };
        // (() => {
        //     for (let i = 0; i < 6; i++) {
        //         loadFaces(i, i);
        //     }
        // })();

        // function loadFaces(i, face) {
        //     var x = 0,
        //         y = 0;
        //     var canvas = document.getElementById('face' + i.toString());
        //     var context = canvas.getContext('2d');
        //     for (var k = 0; k < 16; k++) {
        //         if (x > 3) {
        //             x = 0;
        //             y++;
        //         }
        //         loadFaceBlocks(face, k, x, y, context);
        //         x++;
        //     }
        // }

        // function loadFaceBlocks(face, block, x, y, context) {
        //     var id = face + '_' + y + '_' + x;
        //     if (typeof resorts[id] != 'undefined') id = resorts[id];
        //     var url = '/images/2/2k_face' + id + '.jpg';
        //     const loader = new THREE.ImageLoader();
        //     loader.load(url,
        //         function(image) {
        //             context.font = "30px Arial";
        //             context.fillText(id, image.width * x - 512, image.height * y + 250);
        //             context.drawImage(image, image.width * x, image.height * y);
        //         },
        //     );
        // }

        var scene = new THREE.Scene();
        var camera;
        var controls;
        var container;
        var materials = [];
        var contexts = [];

        init();
        animate();

        function init() {
            container = document.getElementById('container');
            camera = new THREE.PerspectiveCamera(90, window.innerWidth / window.innerHeight, 0.1, 100);
            camera.position.z = 0.01;
            renderer = new THREE.WebGLRenderer();
            renderer.setPixelRatio(window.devicePixelRatio);
            renderer.setSize(window.innerWidth, window.innerHeight);
            container.appendChild(renderer.domElement);

            controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableZoom = true;
            controls.enablePan = false;
            controls.enableDamping = true;
            controls.rotateSpeed = -0.25;
            controls.maxDistance = 0.15;
            controls.minDistance = -0.15;

            // right, left, top, bottom
            // var faces = ['512_face4_0_0.jpg', '512_face2_0_0.jpg', '512_face0_0_0.jpg', '512_face5_0_0.jpg', '512_face3_0_0.jpg', '512_face1_0_0.jpg'];
            var faces = [4, 2, 0, 5, 3, 1];
            for (let i = 0; i < 6; i++) {
                var texture = getTexture(faces[i]);
                materials.push(new THREE.MeshBasicMaterial({
                    map: texture
                }));
            }

            const skyBox = new THREE.Mesh(new THREE.BoxGeometry(1, 1, 1), materials);
            skyBox.geometry.scale(1, 1, -1);
            scene.add(skyBox);

            window.addEventListener('resize', onWindowResize);
        }

        function animate() {
            requestAnimationFrame(animate);
            controls.update(); // required when damping is enabled
            renderer.render(scene, camera);
        }

        // function getTexture(id) {
        //     var x = 0;
        //     var y = 0;
        //     let canvas, context;
        //     const output = new THREE.Texture();
        //     const loader = new THREE.ImageLoader();

        //     contexts.push(document.createElement('canvas').getContext('2d'));
        //     var contextIndex = contexts.length - 1;

        //     contexts[contextIndex].width = 2048;
        //     contexts[contextIndex].height = 2048;

        //     for (var i = 0; i < 16; i++) {
        //         if (x > 3) {
        //             x = 0;
        //             y++;
        //         }

        //         var url = '/images/2/2k_face' + id + '_' + y + '_' + x + '.jpg';
        //         (function(url, x, y, i) {
        //             loader.load(url, function(image) {
        //                 contexts[contextIndex].drawImage(image, image.width * x, image.height * y, image.width, image.height, 0, 0, image.width, image.height);
        //                 console.log('loading', i, url, image.width * x, image.height * y);

        //                 output.image = image;
        //                 output.needsUpdate = true;
        //             });
        //         })(url, x, y, i);

        //         x++;
        //     }

        //     // loader.load(url,
        //     //     function(image) {
        //     //         let canvas, context;

        //     //         canvas = document.createElement('canvas');
        //     //         context = canvas.getContext('2d');

        //     //         const imageWidth = image.height;
        //     //         const imageHeight = image.height;
        //     //         canvas.height = imageWidth;
        //     //         canvas.width = imageHeight;

        //     //         context.drawImage(image, 0, 0, imageWidth, imageHeight, 0, 0, imageWidth, imageHeight);

        //     //         output.image = canvas;
        //     //         output.needsUpdate = true;
        //     //         if (url.includes('face0') || url.includes('face5')) {
        //     //             output.rotation = Math.PI;
        //     //             output.center = new THREE.Vector2(0.5, 0.5);
        //     //         }
        //     //     },
        //     //     undefined,
        //     //     function() {
        //     //         console.error('getTexture', 'An error happened.', url);
        //     //     }
        //     // );
        //     return output;
        // }

        function getTexture(id) {
            var url = '/images/2/512_face' + id + '_0_0.jpg';
            const output = new THREE.Texture();
            const loader = new THREE.ImageLoader();
            console.log('loaded', url);
            loader.load(url,
                function(image) {
                    let canvas, context;

                    canvas = document.createElement('canvas');
                    context = canvas.getContext('2d');

                    const imageWidth = image.height;
                    const imageHeight = image.height;
                    canvas.height = imageWidth;
                    canvas.width = imageHeight;

                    context.drawImage(image, 0, 0, imageWidth, imageHeight, 0, 0, imageWidth, imageHeight);

                    output.image = canvas;
                    output.needsUpdate = true;
                    if (url.includes('face0') || url.includes('face5')) {
                        output.rotation = Math.PI;
                        output.center = new THREE.Vector2(0.5, 0.5);
                    }
                },
                undefined,
                function() {
                    console.error('getTexture', 'An error happened.', url);
                }
            );
            return output;
        }

        function onWindowResize() {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }
    </script>
</body>

</html>