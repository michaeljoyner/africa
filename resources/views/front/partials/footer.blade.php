<footer class="main-footer">
    <div class="footer-column quick-links">
        <h3 class="footer-section-header">Quicklinks</h3>
        <ul>
            <li><a href="#">Top</a></li>
            <li><a href="/#about">About</a></li>
            <li><a href="/#team">Team</a></li>
            <li><a href="/gallery">Gallery</a></li>
            <li><a href="/#partners">Partners</a></li>
            <li><a href="/#sponsors">Sponsors</a></li>
            <li><a href="/#compliance">Compliance</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
    </div>
    <div class="footer-column contact">
        <h3 class="footer-section-header">Get in Touch</h3>
        <p>+27 83 567 8956</p>
        <p>hello@afc.com</p>
        <div class="social-icon-row">
            <a href="#">
                @include('svgicons.social.facebook')
            </a>
            <a href="#">
                @include('svgicons.social.twitter')
            </a>
            <a href="#">
                @include('svgicons.social.instagram')
            </a>
            <a href="#">
                @include('svgicons.social.youtube')
            </a>
        </div>
    </div>
    <div class="footer-column">
        <h3 class="footer-section-header">Latest Expeditions</h3>
        @foreach($latestExpeditions as $slug => $expName)
            <p><a href="/expeditions/{{ $slug }}">{{ $expName }}</a></p>
        @endforeach
    </div>
</footer>