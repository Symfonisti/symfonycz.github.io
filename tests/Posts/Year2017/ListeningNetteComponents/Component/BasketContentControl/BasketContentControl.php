<?php

declare(strict_types=1);

namespace Pehapkari\Website\Tests\Posts\Year2017\ListeningNetteComponents\Component\BasketContentControl;

use Nette\Application\UI\Control;
use Pehapkari\Website\Tests\Posts\Year2017\ListeningNetteComponents\Event\ProductAddedToBasketEvent;


final class BasketContentControl extends Control
{

	/**
	 * @var array
	 */
	private $products = [];


	// This method is called by EventSubscriber because is set as listener callback in CategoryPresenter::startup()
	public function onProductAddedToBasketEvent(ProductAddedToBasketEvent $productAddedToBasketEvent)
	{
		$product = [
			'id' => $productAddedToBasketEvent->getId(),
			'name' => $productAddedToBasketEvent->getName(),
			'price' => $productAddedToBasketEvent->getPrice(),
		];

		$this->products[] = $product;

		$this->redrawControl('content');
	}


	public function render()
	{
		$this->template->setParameters([
			'products' => $this->products
		]);

		$this->template->render(__DIR__ . '/templates/default.latte');
	}

}