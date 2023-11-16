const pElement = document.getElementById("cidade");

async function main() {
    const resultado = await fetch("https://brasilapi.com.br/api/cep/v1/95885000");
    const data = await resultado.json();
    pElement.innerHTML = data.city;
}

main();