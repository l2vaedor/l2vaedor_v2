<footer class="footer">
    <div class="footer__inner">
        <p class="footer__text">© {{ date('Y') }} Vaedor. Independent fan project.</p>

        <nav class="footer__nav" aria-label="Legal">
            <a href="{{ url('/terms') }}" class="footer__link">Terms</a>
            <a href="{{ url('/privacy') }}" class="footer__link">Privacy</a>
            <a href="{{ url('/cookies') }}" class="footer__link">Cookies</a>
        </nav>
    </div>
</footer>
