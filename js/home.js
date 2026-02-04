$(document).ready(function() {
    var caminho = $('#rota').val();
    $('.btn-excluir').on('click', function() {
        const idUsuario = $(this).data('id');
        const botaoClicado = $(this);

        if (confirm('Deseja realmente excluir este usuário?')) {
            $.ajax({
                url: caminho + 'controller/usuario.php',
                type: 'POST', 
                data: {
                    acao: 'delete',
                    id: idUsuario
                },
                success: function(response) {
                    console.log(response)
                    botaoClicado.closest('tr').fadeOut(500, function() {
                        $(this).remove();
                        alert('Usuário removido com sucesso!');
                    });
                },
                error: function() {
                    alert('Erro ao processar a exclusão.');
                }
            });
        }
    });
});