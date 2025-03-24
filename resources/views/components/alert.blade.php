<div id="liveAlertPlaceholder" class="d-flex justify-content-center"></div>

<div class="d-flex justify-content-center mt-3">
    <button type="button" class="btn btn-primary" id="liveAlertBtn">Show live alert</button>
</div>

<script>
    const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
    
    const appendAlert = (message, type) => {
        const wrapper = document.createElement('div');
        wrapper.innerHTML = [
            `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`,
            `   <div>${message}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
        ].join('');

        alertPlaceholder.append(wrapper);
    }

    const alertTrigger = document.getElementById('liveAlertBtn');
    if (alertTrigger) {
        alertTrigger.addEventListener('click', () => {
            appendAlert('Nice, you triggered this alert message!', 'success');
        });
    }
</script>
