$("form").on("submit", function(e)
{
    e.preventDefault();

    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        dataType: "json",
        cache: false,
        data: $(this).serialize(),
        beforeSend: function()
        {
            $("#btnLogin").html("Autenticando...").prop("disabled", true);
        },
        success: function(JsonContent)
        {
            $("#msg").html(formatMessage(JsonContent["error"], JsonContent["message"]));

            if (JsonContent["error"])
            {
                return;
            }

            window.location.href = JsonContent["url"]
        },
        error: function (a, b, c)
        {
            console.log(a, b, c);
        },
        complete: function()
        {
            $("#btnLogin").html("Entrar").prop("disabled", false);
        }
    });
});

const formatMessage = function(error, message)
{
    if (error)
    {
        return `
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div>${message}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `
    } else 
    {
        return `
            <div class="alert alert-success alert-dismissible" role="alert">
                <div>${message}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `
    }
}