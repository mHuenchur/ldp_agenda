document.addEventListener('DOMContentLoaded', () => {

  const form = document.getElementById('formContacto');
  const tipo = document.getElementById('tipo');
  const camposPersona = document.getElementById('camposPersona');
  const camposOrg = document.getElementById('camposOrg');
  const apellido = document.getElementById('apellido');
  const nombre = document.getElementById('nombre');
  const razon = document.getElementById('razon_social');
  const fecha = document.getElementById('fecha_nacimiento');

  // Cambia entre persona u organización
  function toggleTipo() {
    const esPersona = tipo.value === '1';
    camposPersona.classList.toggle('d-none', !esPersona);
    camposOrg.classList.toggle('d-none', esPersona);

    // required dinámicos
    apellido.required = esPersona;
    nombre.required = esPersona;
    fecha.required = esPersona;
    razon.required = !esPersona;

    // limpiar el que no aplica
    if (esPersona) { razon.value = ''; }
    else { apellido.value = ''; nombre.value = ''; fecha.value = '';}
  }

  tipo.addEventListener('change', toggleTipo);
  toggleTipo(); // inicial

  // Teléfonos: agregar / eliminar
  const list = document.getElementById('telList');
  const add  = document.getElementById('btnAdd');

  add.addEventListener('click', () => {
    const base = list.querySelector('.fila');
    const clone = base.cloneNode(true);
    clone.querySelectorAll('input').forEach(i => i.value = '');
    list.appendChild(clone);
  });

  list.addEventListener('click', (e) => {
    const btn = e.target.closest('.btn-del');
    if (!btn) return;
    const filas = list.querySelectorAll('.fila');
    if (filas.length > 1) btn.closest('.fila').remove();
    else btn.closest('.fila').querySelectorAll('input').forEach(i => i.value = '');
  });
});