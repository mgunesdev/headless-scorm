<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>SCORM 1.2 </title>
  <script src="https://cdn.jsdelivr.net/npm/scorm-again@latest/dist/scorm-again.js"></script>
  <style>
    html,body,iframe { width: 100%; height: 100%; padding: 0; margin: 0; border: none}
    iframe { display:block }
  </style>
  <script type="text/javascript">
    const settings = @json($data);
    const token = settings.token;
    const cmi = settings.player.cmi;

    if (settings.version === 'scorm_12') {
        scorm12();
    }

    function scorm12() {
        window.API = new Scorm12API(settings.player);
        window.API.loadFromJSON(cmi);

        window.API.on('LMSSetValue.cmi.*', function(CMIElement, value) {
            const data = {
                cmi: {
                    [CMIElement]: value
                }
            }

            post(data);
        });

        window.API.on('LMSGetValue.cmi.*', function(CMIElement, value) {
            const data = {
                cmi: {
                    [CMIElement]: value
                }
            }

            post(data);
        });

        window.API.on('LMSCommit', function() {
            const data = {
                cmi: window.API.cmi
            }

            post(data);
        });
    }

    function post(data) {
        if (!token) {
            return;
        }

        fetch(settings.lmsUrl + '/' + settings.uuid, {
            method: 'POST',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            },
            body: JSON.stringify(data)
        });
    }

    function get(key) {
        if (!token) {
            return;
        }

        return fetch(settings.lmsUrl + '/' + settings.scorm_id + '/' + key, {
            method: 'GET',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            }
        });
    }

  </script>
</head>

<body>
  <iframe src={{ $data['entry_url_absolute'] }}></iframe>
</body>

</html>
