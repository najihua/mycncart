<?php
class ControllerPaymentPrecharge extends Controller {
	public function index() {
		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['continue'] = $this->url->link('checkout/success');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/precharge')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/precharge', $data);
		} else {
			return $this->load->view('default/template/payment/precharge', $data);
		}
	}

	public function confirm() {
		if ($this->session->data['payment_method']['code'] == 'precharge') {
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('precharge_order_status_id'));
		}
	}
}