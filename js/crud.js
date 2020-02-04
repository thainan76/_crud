var editar = false;

$(document).ready(function() {
    $('#dtBasicExample').DataTable({});
    $('.dataTables_length').addClass('bs-select');
});

function limpaCampo() {

    $('#nome').val('');
    $('#email').val('');
    $('#telefone').val('');
    $('#endereco').val('');
    $('#bairro').val('');

    $('#validaNome').css('display', 'none');
    $('#validaEmail').css('display', 'none');

    $("#botaoAcao").text('Adicionar');
    $("#label").text('Adicionar cliente');

    editar = false;
}

function replaceAll(str, find, replace) {
    return str.replace(new RegExp(find, 'g'), replace);
}

function adicionaCampo(editarId) {

    var editJson = $('#' + editarId).val();

    editJson = JSON.parse(replaceAll(editJson, '-', ' '));

    $('#nome').val(editJson.nome);
    $('#email').val(editJson.email);
    $('#telefone').val(editJson.telefone);
    $('#endereco').val(editJson.endereco);
    $('#bairro').val(editJson.bairro);
    $('#id').val(editJson.id);

    $("#botaoAcao").text('Editar');
    $("#label").text('Editar cliente');

    editar = true;
}

function addOrUpdate() {

    var dados = {};

    dados.nome = $('#nome').val();
    dados.email = $('#email').val();
    dados.telefone = $('#telefone').val();
    dados.endereco = $('#endereco').val();
    dados.bairro = $('#bairro').val();
    dados.id = $('#id').val();

    validacao = true;

    if (dados.nome == '') {
        $('#validaNome').css('display', 'block');
        validacao = false;
    }

    if (dados.email == '') {
        $('#validaEmail').css('display', 'block');
        validacao = false;
    }

    dados = JSON.stringify(dados);

    if (editar) metodo = "editar";
    else metodo = "adicionar";

    if (validacao) {
        $.ajax({
            url: 'crud.php?metodo=' + metodo,
            type: 'GET',
            data: { val: dados },
            success: function(data) {
                console.log(data);
                setTimeout(function() {
                    window.location.reload(1);
                }, 1500);

                Swal.fire(
                    'SUCESSO!',
                    '',
                    'success'
                )

            }
        });
    }

}

function remove(id) {

    var dados = {};

    dados.id = id;

    dados = JSON.stringify(dados);

    Swal.fire({
        title: 'Você tem certeza que deseja excluir?',
        text: "Não poderá voltar atrás!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, deletar!'
    }).then((result) => {
        if (result.value) {

            $.ajax({
                url: 'crud.php?metodo=remover',
                type: 'GET',
                data: { val: dados },
                success: function(data) {
                    console.log(data);
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 1500);
                }
            });

            Swal.fire(
                'Deletado com sucesso!',
                'Cliente foi excluído do sistema.',
                'success'
            )
        }
    })
}