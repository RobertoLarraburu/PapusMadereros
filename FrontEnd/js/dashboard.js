// js/dashboard.js
async function getUserInfo() {
    const token = localStorage.getItem('token');
    if (!token) {
        window.location.href = 'login.html';
        return;
    }
    
    try {
        const response = await fetch('http://localhost:8000/api/user', {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });
        
        if (response.ok) {
            const user = await response.json();
            document.getElementById('userInfo').innerHTML = `
                <p>Nombre: ${user.name}</p>
                <p>Email: ${user.email}</p>
            `;
        } else {
            throw new Error('No se pudo obtener la información del usuario');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error al obtener la información del usuario');
        localStorage.removeItem('token');
        window.location.href = 'login.html';
    }
}

document.getElementById('logoutBtn').addEventListener('click', () => {
    localStorage.removeItem('token');
    window.location.href = 'index.html';
});

getUserInfo();