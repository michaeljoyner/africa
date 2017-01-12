<footer class="main-footer">
    <div class="footer-column quick-links">
        <h3 class="footer-section-header">Quicklinks</h3>
        <ul>
            <li class="light-heading"><a href="#">Top</a></li>
            <li class="light-heading"><a href="/#about">About</a></li>
            <li class="light-heading"><a href="/#team">Team</a></li>
            <li class="light-heading"><a href="/expeditions">Expeditions</a></li>
            <li class="light-heading"><a href="/gallery">Gallery</a></li>
            <li class="light-heading"><a href="/#partners">Partners</a></li>
            <li class="light-heading"><a href="/#sponsors">Sponsors</a></li>
            <li class="light-heading"><a href="/#compliance">Compliance</a></li>
            <li class="light-heading"><a href="/contact">Contact</a></li>
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
        <ul>
            @foreach($latestExpeditions as $slug => $expName)
                <li class="light-heading"><a href="/expeditions/{{ $slug }}">{{ $expName }}</a></li>
            @endforeach
        </ul>
    </div>
</footer>