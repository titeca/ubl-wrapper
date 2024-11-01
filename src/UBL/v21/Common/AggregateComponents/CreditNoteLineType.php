<?php

namespace Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents;

use Uctoplus\UblWrapper\UBL\Schema\AggregateComponent;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\AccountingCostCodeType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\AccountingCostType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\CreditedQuantityType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\FreeOfChargeIndicatorType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\IDType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\LineExtensionAmountType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\NoteType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\PaymentPurposeCodeType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\TaxPointDateType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\UUIDType;

/**
 * Class CreditNoteLineType
 *
 * @copyright uctoplus.sk, a.s.
 * @package Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents
 *
 * @method IDType getID()
 * @method self setID(IDType|string $value)
 * @method UUIDType getUUID()
 * @method self setUUID(UUIDType|string $value)
 * @method NoteType[] getNote()
 * @method self addNote(NoteType|string $value)
 * @method self setNote(NoteType ...$values)
 * @method CreditedQuantityType getCreditedQuantity()
 * @method self setCreditedQuantity(CreditedQuantityType|string $value)
 * @method LineExtensionAmountType getLineExtensionAmount()
 * @method self setLineExtensionAmount(LineExtensionAmountType|string $value)
 * @method TaxPointDateType getTaxPointDate()
 * @method self setTaxPointDate(TaxPointDateType|string $value)
 * @method AccountingCostCodeType getAccountingCostCode()
 * @method self setAccountingCostCode(AccountingCostCodeType|string $value)
 * @method AccountingCostType getAccountingCost()
 * @method self setAccountingCost(AccountingCostType|string $value)
 * @method PaymentPurposeCodeType getPaymentPurposeCode()
 * @method self setPaymentPurposeCode(PaymentPurposeCodeType|string $value)
 * @method FreeOfChargeIndicatorType getFreeOfChargeIndicator()
 * @method self setFreeOfChargeIndicator(FreeOfChargeIndicatorType|string $value)
 * @method PeriodType[] getInvoicePeriod()
 * @method self addInvoicePeriod(PeriodType $value)
 * @method self setInvoicePeriod(PeriodType ...$values)
 * @method OrderLineReferenceType[] getOrderLineReference()
 * @method self addOrderLineReference(OrderLineReferenceType $value)
 * @method self setOrderLineReference(OrderLineReferenceType ...$values)
 * @method ResponseType[] getDiscrepancyResponse()
 * @method self addDiscrepancyResponse(ResponseType $value)
 * @method self setDiscrepancyResponse(ResponseType ...$values)
 * @method LineReferenceType[] getDespatchLineReference()
 * @method self addDespatchLineReference(LineReferenceType $value)
 * @method self setDespatchLineReference(LineReferenceType ...$values)
 * @method LineReferenceType[] getReceiptLineReference()
 * @method self addReceiptLineReference(LineReferenceType $value)
 * @method self setReceiptLineReference(LineReferenceType ...$values)
 * @method BillingReferenceType[] getBillingReference()
 * @method self addBillingReference(BillingReferenceType $value)
 * @method self setBillingReference(BillingReferenceType ...$values)
 * @method DocumentReferenceType[] getDocumentReference()
 * @method self addDocumentReference(DocumentReferenceType $value)
 * @method self setDocumentReference(DocumentReferenceType ...$values)
 * @method PricingReferenceType getPricingReference()
 * @method self setPricingReference(PricingReferenceType $value)
 * @method PartyType getOriginatorParty()
 * @method self setOriginatorParty(PartyType $value)
 * @method DeliveryType[] getDelivery()
 * @method self addDelivery(DeliveryType $value)
 * @method self setDelivery(DeliveryType ...$values)
 * @method PaymentTermsType[] getPaymentTerms()
 * @method self addPaymentTerms(PaymentTermsType $value)
 * @method self setPaymentTerms(PaymentTermsType ...$values)
 * @method TaxTotalType[] getTaxTotal()
 * @method self addTaxTotal(TaxTotalType $value)
 * @method self setTaxTotal(TaxTotalType ...$values)
 * @method AllowanceChargeType[] getAllowanceCharge()
 * @method self addAllowanceCharge(AllowanceChargeType $value)
 * @method self setAllowanceCharge(AllowanceChargeType ...$values)
 * @method ItemType getItem()
 * @method self setItem(ItemType $value)
 * @method PriceType getPrice()
 * @method self setPrice(PriceType $value)
 * @method DeliveryTermsType[] getDeliveryTerms()
 * @method self addDeliveryTerms(DeliveryTermsType $value)
 * @method self setDeliveryTerms(DeliveryTermsType ...$values)
 * @method CreditNoteLineType[] getSubCreditNoteLine()
 * @method self addSubCreditNoteLine(CreditNoteLineType $value)
 * @method self setSubCreditNoteLine(CreditNoteLineType ...$values)
 * @method PriceExtensionType getItemPriceExtension()
 * @method self setItemPriceExtension(PriceExtensionType $value)
 */
class CreditNoteLineType extends AggregateComponent
{
    protected $casts = [
        "cbc:ID" => IDType::class,
        "cbc:UUID" => UUIDType::class,
        "cbc:Note" => NoteType::class . "[]",
        "cbc:CreditedQuantity" => CreditedQuantityType::class,
        "cbc:LineExtensionAmount" => LineExtensionAmountType::class,
        "cbc:TaxPointDate" => TaxPointDateType::class,
        "cbc:AccountingCostCode" => AccountingCostCodeType::class,
        "cbc:AccountingCost" => AccountingCostType::class,
        "cbc:PaymentPurposeCode" => PaymentPurposeCodeType::class,
        "cbc:FreeOfChargeIndicator" => FreeOfChargeIndicatorType::class,
        "cac:InvoicePeriod" => PeriodType::class . "[]",
        "cac:OrderLineReference" => OrderLineReferenceType::class . "[]",
        "cac:DiscrepancyResponse" => ResponseType::class . "[]",
        "cac:DespatchLineReference" => LineReferenceType::class . "[]",
        "cac:ReceiptLineReference" => LineReferenceType::class . "[]",
        "cac:BillingReference" => BillingReferenceType::class . "[]",
        "cac:DocumentReference" => DocumentReferenceType::class . "[]",
        "cac:PricingReference" => PricingReferenceType::class,
        "cac:OriginatorParty" => PartyType::class,
        "cac:Delivery" => DeliveryType::class . "[]",
        "cac:PaymentTerms" => PaymentTermsType::class . "[]",
        "cac:TaxTotal" => TaxTotalType::class . "[]",
        "cac:AllowanceCharge" => AllowanceChargeType::class . "[]",
        "cac:Item" => ItemType::class,
        "cac:Price" => PriceType::class,
        "cac:DeliveryTerms" => DeliveryTermsType::class . "[]",
        "cac:SubCreditNoteLine" => CreditNoteLineType::class . "[]",
        "cac:ItemPriceExtension" => PriceExtensionType::class,
    ];

    protected $minOccurs = [
        "cbc:ID" => 1,
    ];
}