window.addEventListener('load', function() {
    var form = document.getElementById('contactForm');
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        var btn = form.querySelector('button');
        var nameEl = form.querySelector('input[placeholder="Your name"]');
        var emailEl = form.querySelector('input[placeholder="your@email.com"]');
        var msgEl = form.querySelector('textarea');
        
        if (!nameEl.value || !emailEl.value || !msgEl.value) {
            alert('Fill all fields');
            return;
        }
        
        btn.disabled = true;
        btn.textContent = 'Sending...';
        
        fetch('contact.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                name: nameEl.value,
                email: emailEl.value,
                message: msgEl.value
            })
        })
        .then(function(r) { 
            if (!r.ok) {
                throw new Error('Server error');
            }
            return r.json(); 
        })
        .then(function(data) {
            if (data && data.success) {
                btn.textContent = '✓ Sent!';
                btn.style.backgroundColor = '#16a34a';
                btn.style.color = 'white';
                form.reset();
                setTimeout(function() { 
                    btn.textContent = 'Send Message'; 
                    btn.style.backgroundColor = '';
                    btn.style.color = '';
                    btn.disabled = false; 
                }, 2500);
            } else {
                throw new Error('Send failed');
            }
        })
        .catch(function(e) {
            console.error('Error:', e);
            btn.textContent = '✗ Error';
            btn.style.backgroundColor = '#dc2626';
            btn.style.color = 'white';
            setTimeout(function() { 
                btn.textContent = 'Send Message'; 
                btn.style.backgroundColor = '';
                btn.style.color = '';
                btn.disabled = false; 
            }, 2500);
        });
    });
});