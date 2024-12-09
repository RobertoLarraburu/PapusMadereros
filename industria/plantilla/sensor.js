document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('troncosChart').getContext('2d');
    let troncosChart;

    // Crear el gráfico inicial
    function createChart(data) {
        if (troncosChart) {
            troncosChart.destroy(); // Destruir el gráfico previo si existe
        }

        troncosChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map((_, index) => `Tronco ${index + 1}`),
                datasets: [{
                    label: 'Altura de los troncos (CM)',
                    data: data.map(d => d.largo),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: (context) => `Altura: ${context.raw} CM`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Altura (CM)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Troncos'
                        }
                    }
                }
            }
        });
    }

    // Función para actualizar los datos y el gráfico
    async function fetchSensorData() {
        try {
            const response = await fetch('http://localhost/lumen/public/sensor-data');
            if (!response.ok) throw new Error('Error en la solicitud');
            const data = await response.json();

            // Verificar el formato de los datos
            console.log(data); // Ver los datos en consola
            if (!Array.isArray(data) || data.some(d => typeof d.troncos !== 'number' || typeof d.largo !== 'number')) {
                throw new Error('Los datos del servidor no tienen el formato esperado');
            }

            // Obtener el último valor de troncos y largo
            const ultimoDato = data[data.length - 1] || {};
            const troncos = ultimoDato.troncos || 0;
            const largo = ultimoDato.largo || 0;

            // Mostrar troncos y largo en sus respectivos párrafos
            document.getElementById('troncosActuales').textContent = `${troncos}`;
            document.getElementById('largoActual').textContent = `${largo} CM`;

            // Actualizar el gráfico
            createChart(data); // Actualizar gráfico con los datos

        } catch (error) {
            console.error('Error al obtener los datos del sensor:', error);
            document.getElementById('troncosActuales').textContent = 'Error al cargar los datos';
            document.getElementById('largoActual').textContent = 'Error al cargar los datos';
        }
    }

    // Llamar a fetchSensorData cada 2 segundos
    fetchSensorData(); // Llamada inicial
    setInterval(fetchSensorData, 2000); // Actualizar cada 2 segundos
});