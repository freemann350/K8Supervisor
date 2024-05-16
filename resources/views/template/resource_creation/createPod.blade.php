<script>
    let containerCount = 0;
    
    function appendInput(baseDivName, inputName) {
        const baseDiv = document.getElementById(baseDivName);
        const baseInput = document.createElement('div');
        
        if (baseDivName === 'labels' || baseDivName === 'annotations') {
            baseInput.innerHTML = `
            <div class="input-group mb-3 dynamic-input">
                <div class="input-group-prepend">
                    <span class="input-group-text">Key</span>
                </div>
                <input type="text" class="form-control" name="key_${inputName}">
                <div class="input-group-prepend">
                    <span class="input-group-text">Value</span>
                </div>
                <input type="text" class="form-control" name="value_${inputName}">
                <button type="button" class="btn btn-danger removeInput"><i class="ti-trash removeInput"></i></button>
            </div>
            `;
        }

        if (baseDivName === 'containers') {
            containerCount++;
            baseInput.innerHTML = `
            <div class="container mt-4 dynamic-input">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Container #${containerCount} Details</h5>
                        <hr>
                        <div class="form-group">
                            <label class="col-form-label">Container name *</label>
                            <input type="text" name="containers[${containerCount}][name]" class="form-control" placeholder="my-container">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Container image *</label>
                            <input type="text" name="containers[${containerCount}][image]" class="form-control" placeholder="my-container">
                        </div>
                        <div>
                            <h6>Ports</h6>
                            <button type="button" class="btn btn-dark" onclick="addPort(${containerCount})">Add Port</button>
                            <div id="ports-${containerCount}"></div>
                        </div>
                        <div>
                            <h6>Environment Variables</h6>
                            <button type="button" class="btn btn-dark" onclick="addEnv(${containerCount})">Add Environment Variable</button>
                            <div id="env-${containerCount}"></div>
                        </div>
                        <button type="button" class="btn btn-danger removeInput mt-3"><i class="ti-trash removeInput"></i> Remove Container</button>
                    </div>
                </div>
            </div>
            `;
        }

        baseDiv.appendChild(baseInput);
    }

    function addPort(containerId) {
        const portDiv = document.createElement('div');
        portDiv.classList.add('input-group', 'mb-3', 'dynamic-input');
        portDiv.innerHTML = `
            <input type="text" class="form-control" name="containers[${containerId}][ports][]" placeholder="Port">
            <button type="button" class="btn btn-danger removeInput"><i class="ti-trash removeInput"></i></button>
        `;
        document.getElementById(`ports-${containerId}`).appendChild(portDiv);
    }

    function addEnv(containerId) {
        const envDiv = document.createElement('div');
        envDiv.classList.add('input-group', 'mb-3');
        envDiv.innerHTML = `
            <div class="input-group mb-3 dynamic-input">
                <div class="input-group-prepend">
                    <span class="input-group-text">Key</span>
                </div>
                <input type="text" class="form-control" name="containers[${containerId}][env][key][]" placeholder="Key">
                <div class="input-group-prepend">
                    <span class="input-group-text">Value</span>
                </div>
                <input type="text" class="form-control" name="containers[${containerId}][env][value][]" placeholder="Value">
                <button type="button" class="btn btn-danger removeInput"><i class="ti-trash removeInput"></i></button>
            </div>
        `;
        document.getElementById(`env-${containerId}`).appendChild(envDiv);
    }

    function removeElement(element) {
        element.parentElement.remove();
    }

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('removeInput')) {
            event.target.closest('.dynamic-input').remove();
        }
    });
</script>