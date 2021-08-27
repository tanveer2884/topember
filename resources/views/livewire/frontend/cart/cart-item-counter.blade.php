<a class="nav-link" href="{{ route('cart') }}">
    @if(!Cart::isEmpty())
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="26" viewBox="0 0 32 26">
        <image width="32" height="26"
            xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAaCAYAAADWm14/AAAC70lEQVRIib2WS2wPURTGf/8+PVpaqUcjFuLVRkRKIpVQYmEhLFjQZSU2bCxsPJYsiEh3YsMOiUSjjdAQiTSaYNGFVxBtoqRE00SVEn0cOc03MsadfyeoL5m5M+fcx7nf/e65N2dmJ4E9QA4woBDolu0DUw0ze2FhHDEzpvpxBtYCW8XAmGZeBzwF1gDfp5SDwAx3x/ho+B8MJGOq1OyrgSfAI9kjjfxNGUcBcCcUgOMssH8qmRc+pgWwAehQ1C+BV9odEbxRMbBRDPVrRo5xoBxYBzwEhmK+yL8eqAA609amyMy6pIPWlDoFZtZrZrsCvjoze29mCwO+SjN7p74PF/w++QmMAhf07TtkeaCOz+STtJJElVj6EvBtBhZox91KC8DRAgwC04DdKXUGRGUSZcBXX+OAb7vKZ8DjojwB9AE3gUbgALAUKE0wsAKYB9QAUV+jYmwucCmhfvdt0/dtYCQfA46LKp3mleog6nBcFM+SLbJ7ORv4rGWID+6TmKP/GxPvSRLFDDPrlmCaA/7TZtYesHvdloD9mPpy8Za7bTIGhoFr+m7UzOLoV+JKolr6SGKn/ju0PcmngQiXgYNSbhNwXTlhTAKtlAbGVN9pXwQ8B5YoB5joX/UL/b5eKYkojoKJhAH1WvfhWKeejEqk+KgjL2e6wHSQRam7RPWHFHBfVgbGxUK9Bi4L1JkesBXrSaI9GjwrA4jSJ1K854fzsdQc6iCXsOdiz724PrIw4HgDXAX2al3va5uFRBw6+RzfQh1nDaAkNthqHU4jKQOFkFPALr6jyrAKN9vFoTnl2vYnaNVhl3ohSWKx8rZvuTbgAXBIGa1Th1Zh4qLi7OzQvvcdcgaYD+yTf5NyQSYGGmKzrJHtiv5D2S56TqpOl/5LzWxQtqaoXhYN9EpAzsApMbBFvrd52kW+WuC4Elm5bD3/QgMDZlabp01VypW/La6BrAF4gxNm9lIHyV0zq8/QbplE99rMeszsnJlV/PSb8QNxKNsTRRzs0wAAAABJRU5ErkJggg==" />
    </svg>
    <span class="cart-counter">{{ $qty }}</span>
    @endif
</a>