<div>
    <h2>Check product price</h2>
    <form wire:submit="checkPrice">
        <label>
            <span>Products (Insert product SKU's separated by commas please)</span><br>
            <textarea name="" id="" cols="30" rows="10" wire:model="product_code"></textarea>
            <br>
            @error('product_code')
                <em>{{ $message }}</em>
            @enderror
        </label>
        <br>
        <br>
        <label>
            <span>Account</span>
            <input type="text" wire:model="account_id">
            @error('account_id')
                <em>{{ $message }}</em>
            @enderror
        </label>

        <button type="submit">Check Price</button>
    </form>

    <p>The result is {{ $result }}</p>


</div>
