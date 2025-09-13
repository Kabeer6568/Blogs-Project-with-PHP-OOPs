</main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><i class="fas fa-blog"></i> BlogSpace</h3>
                    <p>Share your thoughts and connect with the world through our blogging platform.</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="<?php echo isset($home_path) ? $home_path : ''; ?>index.php">Home</a></li>
                        <li><a href="<?php echo isset($home_path) ? $home_path : ''; ?>about.php">About</a></li>
                        <li><a href="<?php echo isset($home_path) ? $home_path : ''; ?>contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 BlogSpace. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script src="<?php echo isset($js_path) ? $js_path : ''; ?>assets/js/style.js"></script>
</body>
</html>