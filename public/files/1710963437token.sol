// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import "@openzeppelin/contracts/token/ERC20/ERC20.sol";
import "@openzeppelin/contracts/access/Ownable.sol";

contract MyStablecoin is ERC20, Ownable {
    uint256 private constant INITIAL_SUPPLY = 1000000000 * (10**18); // 1 billion initial supply
    uint256 private constant MAX_SUPPLY = 10000000000 * (10**18);    // 10 billion max supply
    uint256 private constant PRICE_DECIMALS = 8;                      // Decimals for price precision
    uint256 public constant TARGET_PRICE = 1 * (10**PRICE_DECIMALS);   // Target price: 1 USD

    event Mint(address indexed to, uint256 amount);
    event Burn(address indexed from, uint256 amount);

    constructor() ERC20("USD", "usdt") {
        _mint(msg.sender, INITIAL_SUPPLY);
    }

    modifier withinSupplyLimit(uint256 amount) {
        require(totalSupply() + amount <= MAX_SUPPLY, "Exceeds max supply");
        _;
    }

    function mint(address to, uint256 amount) external onlyOwner withinSupplyLimit(amount) {
        _mint(to, amount);
        emit Mint(to, amount);
    }

    function burn(uint256 amount) external withinSupplyLimit(amount) {
        _burn(msg.sender, amount);
        emit Burn(msg.sender, amount);
    }

    // Additional functions for maintaining stability can be implemented, such as adjusting the supply based on the coin's market price.

    // Remember to test thoroughly on the TRON testnet before deploying to the mainnet.
}
